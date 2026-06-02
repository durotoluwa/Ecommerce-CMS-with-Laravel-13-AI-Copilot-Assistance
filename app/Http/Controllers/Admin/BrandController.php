<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreBrand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = StoreBrand::whereNull('parent_id')->with('children')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('store_brand', 'name'),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('store_brand', 'slug'),
            ],
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:store_brand,id',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.unique' => 'This brand name already exists.',
            'slug.unique' => 'This brand slug already exists.',
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

        StoreBrand::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'parent_id'   => $request->parent_id,
            'thumbnail'   => $thumbnailPath,
        ]);

        return redirect()->route('admin.brands.index')
                         ->with('success','Brand created successfully');
    }

    public function update(Request $request, StoreBrand $brand)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('store_brand', 'name')->ignore($brand->id),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('store_brand', 'slug')->ignore($brand->id),
            ],
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:store_brand,id',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.unique' => 'This brand name already exists.',
            'slug.unique' => 'This brand slug already exists.',
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        $thumbnailPath = $brand->thumbnail; // keep old if not replaced
        if ($request->hasFile('thumbnail')) {
            $file     = $request->file('thumbnail');
            $filename = time().'_'.$file->getClientOriginalName();

            $destination = $_SERVER['DOCUMENT_ROOT'].'/website';
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $thumbnailPath = 'website/'.$filename;
        }

        $brand->update([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'parent_id'   => $request->parent_id,
            'thumbnail'   => $thumbnailPath,
        ]);

        return redirect()->route('admin.brands.index')
                         ->with('success','Brand updated successfully');
    }

    public function edit(StoreBrand $storeBrand)
    {
        $brands = StoreBrand::all(); // all possible parents
        return view('admin.brands.edit', compact('storeBrand','brands'));
    }

    public function destroy(StoreBrand $storeBrand)
    {
        $storeBrand->delete();
        return redirect()->route('admin.brands.index')
                         ->with('success','Brand deleted successfully');
    }
}
