<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
   public function index()
{
    $attributes = Attribute::all();
    return view('admin.attributes.index', compact('attributes'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('attributes', 'name'),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('attributes', 'slug'),
        ],
        'type' => 'nullable|string|max:50',
    ], [
        'name.unique' => 'This attribute name already exists.',
        'slug.unique' => 'This attribute slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    Attribute::create([
        'name' => $request->name,
        'slug' => $slug,
        'type' => $request->type ?? 'select',
    ]);

    return redirect()->route('admin.attributes.index')
                     ->with('success','Attribute created successfully');
}

public function update(Request $request, Attribute $attribute)
{
    $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('attributes', 'name')->ignore($attribute->id),
        ],
        'slug' => [
            'nullable',
            'string',
            'max:255',
            Rule::unique('attributes', 'slug')->ignore($attribute->id),
        ],
        'type' => 'nullable|string|max:50',
    ], [
        'name.unique' => 'This attribute name already exists.',
        'slug.unique' => 'This attribute slug already exists.',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    $attribute->update([
        'name' => $request->name,
        'slug' => $slug,
        'type' => $request->type ?? 'select',
    ]);

    return redirect()->route('admin.attributes.index')
                     ->with('success', 'Attribute updated successfully');
}






public function edit(Attribute $attribute)
{
    return view('admin.attributes.edit', compact('attribute'));
}


public function destroy(Attribute $attribute)
{
    $attribute->delete();

    return redirect()->route('admin.attributes.index')
                     ->with('success', 'Attribute deleted successfully');
}


}
