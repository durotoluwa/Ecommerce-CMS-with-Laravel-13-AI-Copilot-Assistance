<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use SEOMeta;
use OpenGraph;
use TwitterCard;

class PageController extends Controller
{
   /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $posts = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('posts'));
    }

    public function create()
    {
      
        return view('admin.pages.create');
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'title'            => 'required|string|max:255',
        'content'          => 'required',
       
        'featured_image'   => 'nullable|image',
        'publish_type'     => 'required|in:immediately,schedule',
        'publish_date'     => 'nullable|date',
        'status'           => 'required|in:active,hidden',
        'seo_title'            => 'required|string|max:255',
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

        $destination = $_SERVER['DOCUMENT_ROOT'].'/page';
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $filename = time().'_'.$image->getClientOriginalName();
        $image->move($destination, $filename);

        $validated['featured_image'] = '/page/'.$filename;
    }

    $post = Page::create($validated);

    return redirect()->route('pages.edit', $post->id)
                     ->with('success', 'page post created! You can edit it now.');
}



    /**
     * Display the specified resource.
     */
  public function show(Page $page)
    {
        // SEO integration
        SEOMeta::setTitle($page->title);
        SEOMeta::setDescription($page->seo_description ?? $page->short_description);
        SEOMeta::addKeyword(explode(',', $page->seo_keywords));

        OpenGraph::setTitle($page->title)
                 ->setDescription($page->seo_description ?? $page->short_description)
                 ->setUrl(url()->current())
                 ->addImage(asset('storage/'.$page->featured_image));

        TwitterCard::setTitle($page->title)
                   ->setDescription($page->seo_description ?? $page->short_description);

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Page $page)
{
    
    return view('admin.pages.edit', compact('page'));
}


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    $post = Page::findOrFail($id);

    $validated = $request->validate([
        'title'            => 'required|string|max:255',
        'content'          => 'required',
        'featured_image'   => 'nullable|image',
        'publish_type'     => 'required|in:immediately,schedule',
        'publish_date'     => 'nullable|date',
        'status'           => 'required|in:active,pending,draft',
        'seo_keywords'     => 'nullable|string',
        'seo_title'        => 'nullable|string|max:255',
        'seo_description'  => 'nullable|string|max:160',

         
    ]);

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $destination = $_SERVER['DOCUMENT_ROOT'].'/page';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $filename = time().'_'.$image->getClientOriginalName();
        $image->move($destination, $filename);

        $validated['featured_image'] = '/page/'.$filename;
    }

    $post->update($validated);

    return redirect()->route('pages.edit', $post->id)
                     ->with('success', 'Page post updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $post = Page::findOrFail($id);

    // pages_category Delete featured image file if it exists
    if ($post->featured_image) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $post->featured_image;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // pages_category Delete the post itself
    $post->delete();

    return redirect()->route('pages.index')
                     ->with('success', 'Page post and featured image deleted successfully!');
}

}
