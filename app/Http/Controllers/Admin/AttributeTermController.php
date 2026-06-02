<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeTerm;
  use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AttributeTermController extends Controller
{
   
    /**
     * Display a listing of the terms for a given attribute.
     */
    public function index(Attribute $attribute)
    {
        $terms = $attribute->terms;
        return view('admin.attribute_terms.index', compact('attribute','terms'));
    }

    /**
     * Show the form for creating a new term.
     */
    public function create(Attribute $attribute)
    {
        return view('admin.attribute_terms.create', compact('attribute'));
    }

    /**
     * Store a newly created term in storage.
     */


public function store(Request $request, Attribute $attribute)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('attribute_terms')->where(function ($query) use ($attribute) {
                return $query->where('attribute_id', $attribute->id);
            }),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('attribute_terms')->where(function ($query) use ($attribute) {
                return $query->where('attribute_id', $attribute->id);
            }),
        ],
    ], [
        'name.unique' => 'This name already exists for the selected attribute.',
        'slug.unique' => 'This slug already exists for the selected attribute.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    $attribute->terms()->create([
        'name' => $request->name,
        'slug' => $slug,
    ]);

    return redirect()->route('admin.attribute_terms.index', $attribute->id)
                     ->with('success','Term created successfully');
}


    /**
     * Show the form for editing the specified term.
     */
    public function edit(Attribute $attribute, AttributeTerm $term)
    {
        return view('admin.attribute_terms.edit', compact('attribute','term'));
    }

    /**
     * Update the specified term in storage.
     */
   public function update(Request $request, Attribute $attribute, AttributeTerm $term)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('attribute_terms')->where(function ($query) use ($attribute) {
                return $query->where('attribute_id', $attribute->id);
            })->ignore($term->id),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('attribute_terms')->where(function ($query) use ($attribute) {
                return $query->where('attribute_id', $attribute->id);
            })->ignore($term->id),
        ],
    ], [
        'name.unique' => 'This name already exists for the selected attribute.',
        'slug.unique' => 'This slug already exists for the selected attribute.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    $term->update([
        'name' => $request->name,
        'slug' => $slug,
    ]);

    return redirect()->route('admin.attribute_terms.index', $attribute->id)
                     ->with('success','Term updated successfully');
}

    /**
     * Remove the specified term from storage.
     */
    public function destroy(Attribute $attribute, AttributeTerm $term)
    {
        $term->delete();

        return redirect()->route('admin.attribute_terms.index', $attribute->id)
                         ->with('success','Term deleted successfully');
    }
public function storeAttributeItem(Request $request, Attribute $attribute)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $term = $attribute->terms()->create([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
    ]);

    // Return the actual term data
  return response()->json([
    'id' => $term->id,
    'name' => $term->name,
]);
}















}
