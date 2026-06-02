<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerSlider;

class BannerSliderController extends Controller
{
    public function index()
    {
        $sliders = BannerSlider::all();
        return view('admin.banner_sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.banner_sliders.create');
    }

public function store(Request $request)
{
    $request->validate([
        'heading1'     => 'nullable|string|max:255',
        'heading2'     => 'nullable|string|max:255',
        'button_title' => 'nullable|string|max:255',
        'button_link'  => 'nullable|string|max:500',
        'slider_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
       
    ]);

    // Define destination path
    $destination = $_SERVER['DOCUMENT_ROOT'].'/website/banner_sliders';

    // Ensure folder exists
    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    // Move uploaded file
    $file = $request->file('slider_image');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->move($destination, $filename);

    
    BannerSlider::create([
        'heading1'     => $request->heading1,
        'heading2'     => $request->heading2,
        'button_title' => $request->button_title,
        'button_link'  => $request->button_link,
        'slider_image' => 'website/banner_sliders/'.$filename, // relative path
        
    ]);

    return redirect()->route('banner_sliders.index')->with('success','Banner slider created!');
}




    public function edit($id)
    {
        $slider = BannerSlider::findOrFail($id);
        return view('admin.banner_sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
{
    $slider = BannerSlider::findOrFail($id);

    $request->validate([
        'heading1'     => 'nullable|string|max:255',
        'heading2'     => 'nullable|string|max:255',
        'button_title' => 'nullable|string|max:255',
        'button_link'  => 'nullable|string|max:500',
        'slider_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
       
    ]);

    if ($request->hasFile('slider_image')) {
        $destination = $_SERVER['DOCUMENT_ROOT'].'/website/banner_sliders';

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file = $request->file('slider_image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move($destination, $filename);

        $slider->slider_image = 'website/banner_sliders/'.$filename;
    }

    $slider->update([
        'heading1'     => $request->heading1,
        'heading2'     => $request->heading2,
        'button_title' => $request->button_title,
        'button_link'  => $request->button_link,
        'status'       => $request->status,
 
    ]);

    return redirect()->route('banner_sliders.index')->with('success','Banner slider updated!');
}


public function destroy($id)
{
    $slider = BannerSlider::findOrFail($id);
    $slider->delete();

    return redirect()->route('banner_sliders.index')
                     ->with('success', 'Banner slider deleted successfully!');
}


}
