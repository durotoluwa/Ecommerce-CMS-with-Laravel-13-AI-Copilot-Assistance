<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
     public function index()
{
    // Fetch top-level categories with children
    $categories = BlogCategory::whereNull('parent_id')->with('children')->get();
    return view('admin.blog_category.index', compact('categories'));
}

public function create()
{
    $categories = BlogCategory::all();
    return view('admin.blog_category.create', compact('categories'));
}



public function store(Request $request)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('blog_category', 'name'),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('blog_category', 'slug'),
        ],
        'description' => 'nullable|string',
        'parent_id'   => 'nullable|exists:blog_category,id',
        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ], [
        'name.unique' => 'This category name already exists.',
        'slug.unique' => 'This category slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

   

    BlogCategory::create([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
        'parent_id'   => $request->parent_id,
         
     
    ]);

return back()->with('success', 'Category created successfully');

}






public function update(Request $request, BlogCategory $blog_category)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('blog_category', 'name')->ignore($blog_category->id),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('blog_category', 'slug')->ignore($blog_category->id),
        ],
        'description' => 'nullable|string',
        'parent_id'   => 'nullable|exists:blog_category,id',
 
    ], [
        'name.unique' => 'This category name already exists.',
        'slug.unique' => 'This category slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

     

    $blog_category->update([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
        'parent_id'   => $request->parent_id,
         
    ]);

 return back()->with('success', 'Category Updated successfully');
}




public function edit(BlogCategory $blog_category)
{
    $categories = BlogCategory::all();
    return view('admin.blog_category.edit', compact('blog_category','categories'));
}


public function destroy(BlogCategory $blog_category)
{
    $blog_category->delete();
  return back()->with('success', 'Category Deleted successfully');
}

 
}
