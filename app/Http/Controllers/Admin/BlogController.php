<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use SEOMeta;
use OpenGraph;
use TwitterCard;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $postCategories = \App\Models\BlogCategory::all();
        return view('admin.blog.create', compact('postCategories'));
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'title'            => 'required|string|max:255',
        'content'          => 'required',
        'blog_category_id' => 'required|exists:blog_category,id',
        'featured_image'   => 'nullable|image',
        'publish_type'     => 'required|in:immediately,schedule',
        'publish_date'     => 'nullable|date',
        'status'           => 'required|in:active,hidden',
        'short_description'=> 'nullable|string|max:200',
        'seo_title'=> 'nullable|string|max:200',
        'seo_keywords'     => 'nullable|string',
        'seo_description'  => 'nullable|string|max:160',
    ]);

    //  If no publish_date is provided, set it to now
    if (empty($validated['publish_date'])) {
        $validated['publish_date'] = now();
    }

    //  Add the current logged-in user as author
    $validated['user_id'] = auth()->id();

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');

        $destination = $_SERVER['DOCUMENT_ROOT'].'/blog';
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $filename = time().'_'.$image->getClientOriginalName();
        $image->move($destination, $filename);

        $validated['featured_image'] = '/blog/'.$filename;
    }

    $post = BlogPost::create($validated);

    return redirect()->route('blog.edit', $post->id)
                     ->with('success', 'Blog post created! You can edit it now.');
}



    /**
     * Display the specified resource.
     */
  public function show(BlogPost $blog)
    {
        // SEO integration
        SEOMeta::setTitle($blog->title);
        SEOMeta::setDescription($blog->seo_description ?? $blog->short_description);
        SEOMeta::addKeyword(explode(',', $blog->seo_keywords));

        OpenGraph::setTitle($blog->title)
                 ->setDescription($blog->seo_description ?? $blog->short_description)
                 ->setUrl(url()->current())
                 ->addImage(asset('storage/'.$blog->featured_image));

        TwitterCard::setTitle($blog->title)
                   ->setDescription($blog->seo_description ?? $blog->short_description);

        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(BlogPost $blog)
{
    $postCategories = \App\Models\BlogCategory::all();
    return view('admin.blog.edit', compact('blog', 'postCategories'));
}


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    $post = BlogPost::findOrFail($id);

    $validated = $request->validate([
        'title'            => 'required|string|max:255',
        'content'          => 'required',
        'blog_category_id' => 'required|exists:blog_category,id',
        'featured_image'   => 'nullable|image',
        'publish_type'     => 'required|in:immediately,schedule',
        'publish_date'     => 'nullable|date',
        'status'           => 'required|in:active,pending,draft',
        'short_description'=> 'nullable|string|max:200',
        'seo_keywords'     => 'nullable|string',
        'seo_title'        => 'nullable|string|max:255',
        'seo_description'  => 'nullable|string|max:160',

         
    ]);

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $destination = $_SERVER['DOCUMENT_ROOT'].'/blog';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $filename = time().'_'.$image->getClientOriginalName();
        $image->move($destination, $filename);

        $validated['featured_image'] = '/blog/'.$filename;
    }

    $post->update($validated);

    return redirect()->route('blog.edit', $post->id)
                     ->with('success', 'Blog post updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $post = BlogPost::findOrFail($id);

    // blog_category Delete featured image file if it exists
    if ($post->featured_image) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $post->featured_image;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // blog_category Delete the post itself
    $post->delete();

    return redirect()->route('blog.index')
                     ->with('success', 'Blog post and featured image deleted successfully!');
}

}
