<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\storeBrand;
use App\Models\ProductCategory;
use App\Models\AttributeTerm;
use App\Models\Attribute;
use App\Models\Media;
 use App\Models\ProductGallery;
  use App\Models\Currency;
use App\Models\ProductOrder;
use SEOMeta;
use OpenGraph;
use TwitterCard;
use League\Csv\Reader;
  

class ProductController extends Controller
{

 


    /**
     * Display a listing of the resource.
     */


public function index()
{
    // Eager load category and storeBrand to avoid N+1 queries
   $products = Product::with(['categories', 'storeBrands'])->get();
   $baseCurrency = \App\Models\Currency::where('is_base', true)->first();
$displayCurrency = \App\Models\Currency::where('is_display', true)->first();
    return view('admin.products.index', compact('products', 'baseCurrency', 'displayCurrency'));
}





    /**
     * Show the form for creating a new resource.
     */
 public function create()
    {
        // Supporting data for the product form
        $brands     = storeBrand::all();
        $categories = ProductCategory::with('children')->get(); // eager load subcategories
        $attributes = Attribute::with('terms')->get();          // eager load terms

        // Supporting data for the media library modal
        $dates      = Media::selectRaw('DATE(created_at) as date')
                           ->distinct()
                           ->pluck('date');
        $mediaItems = Media::latest()->paginate(12);

        $baseCurrency = \App\Models\Currency::where('is_base', true)->first();

        return view('admin.products.create', compact(
            'brands',
            'categories',
            'attributes',
            'dates',
            'mediaItems',
            'baseCurrency'
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate request
    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'description'       => 'nullable|string',
        'shortdescription'  => 'nullable|string',
        'regular_price'     => 'nullable|numeric',
        'sale_price'        => 'nullable|numeric|lte:regular_price',
        'sku'               => 'required|string|unique:products,sku',
        'stock_status'      => 'required|in:in_stock,out_of_stock,on_backorder',
        'stock_quantity'    => 'nullable|integer|min:0',
        'seo_title'         => 'nullable|string|max:255',
        'seo_description'   => 'nullable|string|max:160',
        'seo_keywords'      => 'nullable|string',
        'status'            => 'required|in:active,pending,draft',
        'publish_type'      => 'required|in:immediately,schedule',
        'publish_date'      => 'nullable|date',
        'featured_image'    => 'nullable|mimes:jpeg,png,gif|max:2048',
        'gallery.*'         => 'nullable|mimes:jpeg,png,gif|max:2048',
        'categories'        => 'nullable|array',
        'brands'            => 'nullable|array',
        'attribute_terms'   => 'nullable|array',
        'visible_attributes'=> 'nullable|array',
    ]);

    // Add slug from name
    $validated['slug'] = Str::slug($validated['name']);

    //  Default publish_date if not provided
    if (empty($validated['publish_date'])) {
        $validated['publish_date'] = now();
    }

    //  Attach current user
    $validated['user_id'] = auth()->id();

    // Create product record
    $product = Product::create($validated);

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $file     = $request->file('featured_image');
        $filename = time().'_'.$file->getClientOriginalName();

        $destination = public_path('uploads/products/featured');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $product->featured_image = 'uploads/products/featured/'.$filename;
        $product->save();
    }

    // Handle gallery upload
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            $filename = time().'_'.$file->getClientOriginalName();

            $destination = public_path('uploads/products/gallery');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $product->galleries()->create([
                'file_path' => 'uploads/products/gallery/'.$filename,
            ]);
        }
    }

    // Sync categories
    if ($request->filled('categories')) {
        $product->categories()->sync($request->categories);
    }

    // Sync brands
    if ($request->filled('brands')) {
        $product->storeBrands()->sync($request->brands);
    }

    // Save attributes
    if ($request->filled('attribute_terms')) {
        $product->attributeProducts()->delete(); // clear old values

        foreach ($request->attribute_terms as $attributeId => $terms) {
            foreach ($terms as $termId) {
                $product->attributeProducts()->create([
                    'attribute_id' => $attributeId,
                    'term_id'      => $termId,
                    'visible'      => in_array($attributeId, $request->visible_attributes ?? []),
                ]);
            }
        }
    }

    //  Redirect to edit page with public link
    return redirect()->route('admin.products.edit', $product->id)
        ->with('success', 'Product created successfully!')
        ->with('public_link', route('admin.products.show', $product->slug));
}



    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $product = Product::with([
        'categories',
        'storeBrands',
        'attributeProducts.attribute',
        'attributeProducts.term',
        'galleries',
    ])->findOrFail($id);

    $baseCurrency = Currency::where('is_base', true)->first();
    $displayCurrency = Currency::where('is_display', true)->first();

    return view('admin.products.show', [
        'productdetails'   => $product,
        'baseCurrency'     => $baseCurrency,
        'displayCurrency'  => $displayCurrency,
    ]);
}



    /**
     * Show the form for editing the specified resource.
     */
public function edit(string $id)
{
    $product = Product::with([
        'storeBrands',
        'categories',
        'attributeTerms',
        'galleries' // load gallery images
    ])->findOrFail($id);

    $categories   = ProductCategory::with('children')->get();
    $brands       = StoreBrand::all();
    $attributes   = Attribute::with('terms')->get();
    $baseCurrency = \App\Models\Currency::where('is_base', true)->first();

    //  Always generate public link
    $publicLink = route('product.details', $product->slug);

    return view('admin.products.edit', compact(
        'product',
        'categories',
        'brands',
        'attributes',
        'baseCurrency',
        'publicLink'
    ));
}











    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    // Validate request
    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'description'       => 'nullable|string',
        'shortdescription'       => 'nullable|string',
        'regular_price'     => 'nullable|numeric',
        'sale_price'        => 'nullable|numeric',
        'sku'               => 'required|string|unique:products,sku,' . $product->id,
        'stock_status'      => 'required|in:in_stock,out_of_stock,on_backorder',
        'stock_quantity'    => 'nullable|integer|min:0',
        'seo_title'         => 'nullable|string|max:255',
        'seo_description'   => 'nullable|string',
        'seo_keywords'      => 'nullable|string',
        'status'            => 'required|in:active,pending,draft',
        'publish_type'      => 'required|in:immediately,schedule',
        'publish_date'      => 'nullable|date',

        // Featured image
        'featured_image'    => 'nullable|mimes:jpeg,png,gif|max:2048',

        // Gallery images
        'gallery.*'         => 'nullable|mimes:jpeg,png,gif|max:2048',

        'categories'        => 'nullable|array',
        'brands'            => 'nullable|array',
        'attribute_terms'   => 'nullable|array',
        'visible_attributes'=> 'nullable|array',
    ]);

    // Update slug if name changed
    $validated['slug'] = Str::slug($validated['name']);

    // Update product record
    $product->update($validated);

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $file     = $request->file('featured_image');
        $filename = time().'_'.$file->getClientOriginalName();

        $destination = $_SERVER['DOCUMENT_ROOT'].'/uploads/products/featured';
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $product->featured_image = 'uploads/products/featured/'.$filename;
        $product->save();
    }

    // Handle gallery upload (replace old gallery if new files uploaded)
  // Handle gallery upload (append new files instead of replacing)
if ($request->hasFile('gallery')) {
    foreach ($request->file('gallery') as $file) {
        $filename = time().'_'.$file->getClientOriginalName();

        $destination = public_path('uploads/products/gallery');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $product->galleries()->create([
            'file_path' => 'uploads/products/gallery/'.$filename,
        ]);
    }
}


    // Sync categories
    $product->categories()->sync($request->input('categories', []));

    // Sync brands
    $product->storeBrands()->sync($request->input('brands', []));

    // Save attributes
    if ($request->filled('attribute_terms')) {
        $product->attributeProducts()->delete(); // clear old values

        foreach ($request->attribute_terms as $attributeId => $terms) {
            foreach ($terms as $termId) {
                $product->attributeProducts()->create([
                    'attribute_id' => $attributeId,
                    'term_id'      => $termId,
                    'visible'      => in_array($attributeId, $request->visible_attributes ?? []),
                ]);
            }
        }
    }

    return redirect()->route('admin.products.edit', $product->id)
                     ->with('success', 'Product updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    // Delete related galleries
    $product->galleries()->delete();

    // Detach categories and brands
    $product->categories()->detach();
    $product->storeBrands()->detach();

    // Delete attribute relations
    $product->attributeProducts()->delete();

    // Finally delete product
    $product->delete();

    return redirect()->route('admin.products.index')
                     ->with('success', 'Product deleted successfully.');
}



public function storeTerm(Request $request, Attribute $attribute)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $attribute->terms()->create([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
    ]);

    $attribute->load('terms');

    // Render the product‑specific partial
    return view('admin.products._terms', compact('attribute'));
}


public function toggleFeatured(Product $product)
{
    $product->featured = !$product->featured;
    $product->save();

    return response()->json([
        'success' => true,
        'featured' => $product->featured
    ]);
}



public function search34(Request $request)
{
    $query = $request->get('q');

    $products = Product::where('name', 'like', "%{$query}%")
        ->limit(10)
        ->get(['id','name','featured_image']); // keep it simple first

    return response()->json($products);
}

public function search(Request $request)
{
    $query = $request->get('q');

    $products = Product::where('name', 'like', "%{$query}%")
        ->limit(10)
        ->get(['id','name','featured_image','regular_price','sale_price']); 

    return response()->json($products);
}


public function showdetails34($id)
{
    $product = Product::with('categories', 'galleries')->findOrFail($id);

    $relatedProducts = Product::with('categories')
        ->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('product_category.id', $product->categories->pluck('id'));
        })
        ->where('id', '!=', $product->id) // exclude current product
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return view('product.details', compact('product', 'relatedProducts'));
}

public function showdetails($slug)
{
    // Find product by slug instead of ID
    $product = Product::with('categories', 'galleries')
        ->where('slug', $slug)
        ->firstOrFail();

    // Related products: same categories, exclude current product by slug
    $relatedProducts = Product::with('categories')
        ->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('product_category.id', $product->categories->pluck('id'));
        })
        ->where('slug', '!=', $product->slug) // exclude current product
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return view('product.details', compact('product', 'relatedProducts'));
}



public function pendingOrder()
{
    $orders = ProductOrder::with(['customer', 'items.product'])
        ->where('status', 'pending')   //   filter only pending orders
        ->latest()
        ->paginate(100);

    return view('admin.product_orders.pending_product', compact('orders'));
}


public function destroyGallery($productId, $galleryId)
{
    $product = Product::findOrFail($productId);
    $gallery = $product->galleries()->findOrFail($galleryId);

    // Delete file from storage
    $filePath = public_path($gallery->file_path);
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete DB record
    $gallery->delete();

    return response()->json(['success' => true, 'id' => $galleryId]);
}


public function showImportForm()
{
    return view('admin.products.import'); // Blade file for the form
}

public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt'
    ]);

    $path = $request->file('csv_file')->getRealPath();
    $file = fopen($path, 'r');

    // Expected headers
    $expectedHeaders = [
        'name',
        'description',
        'shortdescription',
        'slug',
        'regular_price',
        'sale_price',
        'sku',
        'stock_quantity'
    ];

    // Read header row
    $header = fgetcsv($file);

    // Validate headers
    if ($header === false || array_diff($expectedHeaders, $header)) {
        fclose($file);
        return back()->withErrors([
            'csv_file' => 'Invalid CSV format. Expected headers: ' . implode(', ', $expectedHeaders)
        ]);
    }

    // Process rows
    while (($row = fgetcsv($file)) !== false) {
        $record = array_combine($header, $row);

        Product::updateOrCreate(
            ['sku' => $record['sku']],
            [
                'name'             => $record['name'],
                'description'      => $record['description'],
                'shortdescription' => $record['shortdescription'],
                'slug'             => $record['slug'],
                'regular_price'    => $record['regular_price'],
                'sale_price'       => $record['sale_price'],
                'stock_quantity'   => $record['stock_quantity'],
                'status'           => 'pending',
                'publish_type'     => 'immediately',
                'stock_status'     => $record['stock_quantity'] > 0 ? 'in_stock' : 'out_of_stock',
            ]
        );
    }

    fclose($file);

    return back()->with('success', 'Products imported successfully!');
}




public function downloadSampleCsv()
{
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="sample_products.csv"',
    ];

    $callback = function() {
        $file = fopen('php://output', 'w');

        // Header row
        fputcsv($file, [
            'name','description','shortdescription','slug',
            'regular_price','sale_price','sku','stock_quantity'
        ]);

        // Sample rows
        fputcsv($file, [
            'T-Shirt','Cotton T-shirt with logo','Soft cotton tee','t-shirt',
            '19.99','14.99','TS001','100'
        ]);
        fputcsv($file, [
            'Sneakers','Running sneakers','Lightweight sneakers','sneakers',
            '59.99','49.99','SN001','50'
        ]);
        fputcsv($file, [
            'Watch','Luxury wristwatch','Elegant wristwatch','watch',
            '120','99','WT001','20'
        ]);

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}


  public function OrderPage()
{
    $orders = ProductOrder::with(['customer', 'items.product'])
        ->latest()
        ->paginate(100);

    return view('admin.product_orders.index', compact('orders'));
}

public function showproductOrder($id)
{
    $order = ProductOrder::with(['customer', 'items.product', 'shippingAddress'])
        ->findOrFail($id);

    return view('admin.product_orders.show', compact('order'));
}

public function bulkDelete(Request $request)
{
    $ids = $request->input('selected_products', []);
    if (!empty($ids)) {
        Product::whereIn('id', $ids)->delete();
    }

    return redirect()->route('admin.products.index')
                     ->with('success', 'Selected products deleted successfully.');
}


}
