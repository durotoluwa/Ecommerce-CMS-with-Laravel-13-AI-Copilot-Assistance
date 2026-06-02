<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimony;
 

class TestimonyController extends Controller
{
   public function index()
    {
        $testimonies = Testimony::latest()->paginate(10);
        return view('admin.testimonies.index', compact('testimonies'));
    }

    public function create()
    {
        return view('admin.testimonies.create');
    }

public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'status' => 'required|in:active,pending,draft',
        'customer_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['customer_name','review','rating','title','status']);

    // Handle image upload
    if ($request->hasFile('customer_image')) {
        $destination = $_SERVER['DOCUMENT_ROOT'].'/testimony';
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file = $request->file('customer_image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move($destination, $filename);

        $data['customer_image'] = '/testimony/'.$filename;
    }

    Testimony::create($data);

    return redirect()->route('testimonies.index')
                     ->with('success', 'Testimony created successfully.');
}


    public function edit(Testimony $testimony)
    {
        return view('admin.testimonies.edit', compact('testimony'));
    }

    public function update(Request $request, Testimony $testimony)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'status' => 'required|in:active,pending,draft',
        'customer_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['customer_name','review','rating','title','status']);

    if ($request->hasFile('customer_image')) {
        $destination = $_SERVER['DOCUMENT_ROOT'].'/testimony';
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file = $request->file('customer_image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move($destination, $filename);

        $data['customer_image'] = '/testimony/'.$filename;
    }

    $testimony->update($data);

    return redirect()->route('testimonies.index')
                     ->with('success', 'Testimony updated successfully.');
}


    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return redirect()->route('testimonies.index')
                         ->with('success', 'Testimony deleted successfully.');
    }
}
