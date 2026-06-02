<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tags;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        $tags = tags::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

 public function store(Request $request)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('tags', 'name'),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('tags', 'slug'),
        ],
        'description' => 'nullable|string',
    ], [
        'name.unique' => 'This tag name already exists.',
        'slug.unique' => 'This tag slug already exists.',
    ]);

    $slug = $request->slug ?: \Str::slug($request->name);

    Tags::create([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.tags.index')
                     ->with('success','Tag created successfully');
}
public function update(Request $request, Tags $tag)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('tags', 'name')->ignore($tag->id),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('tags', 'slug')->ignore($tag->id),
        ],
        'description' => 'nullable|string',
    ], [
        'name.unique' => 'This tag name already exists.',
        'slug.unique' => 'This tag slug already exists.',
    ]);

    $slug = $request->slug ?: \Str::slug($request->name);

    $tag->update([
        'name'        => $request->name,
        'slug'        => $slug,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.tags.index')
                     ->with('success','Tag updated successfully');
}



    public function edit(tags $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

public function destroy(Tags $tag)
{
    $tag->delete();

    return redirect()
        ->route('admin.tags.index')
        ->with('success', 'Tag deleted successfully');
}


    
}
