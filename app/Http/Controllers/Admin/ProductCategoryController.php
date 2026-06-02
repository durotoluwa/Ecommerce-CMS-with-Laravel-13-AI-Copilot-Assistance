<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
  public function index()
{
    // Fetch top-level categories with children
    $categories = ProductCategory::whereNull('parent_id')->with('children')->get();
    return view('admin.category.index', compact('categories'));
}

public function create()
{
    $categories = ProductCategory::all();
    return view('admin.category.create', compact('categories'));
}



public function store(Request $request)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('product_category', 'name'),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('product_category', 'slug'),
        ],
        'description' => 'nullable|string',
        'parent_id'   => 'nullable|exists:product_category,id',
        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ], [
        'name.unique' => 'This category name already exists.',
        'slug.unique' => 'This category slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $file     = $request->file('thumbnail');
        $filename = time().'_'.$file->getClientOriginalName();

        $destination = $_SERVER['DOCUMENT_ROOT'].'/attribute';
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);
        $thumbnailPath = 'attribute/'.$filename;
    }

    ProductCategory::create([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
        'parent_id'   => $request->parent_id,
        'thumbnail'   => $thumbnailPath,
     
    ]);

return back()->with('success', 'Category created successfully');

}






public function update(Request $request, ProductCategory $product_category)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('product_category', 'name')->ignore($product_category->id),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('product_category', 'slug')->ignore($product_category->id),
        ],
        'description' => 'nullable|string',
        'parent_id'   => 'nullable|exists:product_category,id',
        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ], [
        'name.unique' => 'This category name already exists.',
        'slug.unique' => 'This category slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    $thumbnailPath = $product_category->thumbnail;
    if ($request->hasFile('thumbnail')) {
        $file     = $request->file('thumbnail');
        $filename = time().'_'.$file->getClientOriginalName();

        $destination = $_SERVER['DOCUMENT_ROOT'].'/attribute';
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);
        $thumbnailPath = 'attribute/'.$filename;
    }

    $product_category->update([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
        'parent_id'   => $request->parent_id,
        'thumbnail'   => $thumbnailPath,
        'featured'    => $request->has('featured'),
    ]);

 return back()->with('success', 'Category Updated successfully');
}




public function edit(ProductCategory $product_category)
{
    $categories = ProductCategory::all();
    return view('admin.category.edit', compact('product_category','categories'));
}


public function destroy(ProductCategory $product_category)
{
    $product_category->delete();
  return back()->with('success', 'Category Deleted successfully');
}

public function categorytoggleFeatured(ProductCategory $productcategory)
{
    $productcategory->featured = !$productcategory->featured;
    $productcategory->save();

    return response()->json([
        'success' => true,
        'featured' => $productcategory->featured
    ]);
}





}
