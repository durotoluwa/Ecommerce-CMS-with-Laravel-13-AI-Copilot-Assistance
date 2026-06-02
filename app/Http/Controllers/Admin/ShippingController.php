<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingZone;
use App\Models\ShippingLocation;
use App\Models\ShippingMethod;
 

class ShippingController extends Controller
{
   public function index()
{
    $zones = ShippingZone::withCount(['locations','methods'])->paginate(20);
    return view('admin.zones.index', compact('zones'));
}


    public function create()
    {
        return view('admin.zones.create');
    }

   public function store(Request $request)
{
    ShippingZone::create($request->only('name'));
    return redirect()->route('admin.zones.index')->with('success','Zone created');
}

    public function show(ShippingZone $shippingZone)
    {
        return view('admin.zones.show', compact('shippingZone'));
    }

    public function edit(ShippingZone $shippingZone)
    {
        return view('admin.zones.edit', compact('shippingZone'));
    }

 public function update(Request $request, ShippingZone $zone)
{
    $zone->update($request->only('name'));
    return redirect()->route('admin.zones.index')->with('success','Zone updated');
}
   public function destroy(ShippingZone $zone)
{
    $zone->delete();
    return redirect()->route('admin.zones.index')->with('success','Zone deleted');
}

    // Extra helpers for locations & methods
public function storeLocation(Request $request, ShippingZone $shippingZone)
{
    $shippingZone->locations()->create($request->only('country','state','city','postal_code'));
    return back()->with('success','Location added');
}


public function storeMethod(Request $request, ShippingZone $shippingZone)
{
    $shippingZone->methods()->create($request->only('method_type','rate'));
    return back()->with('success','Method added');
}


public function destroyMethod(ShippingZone $shippingZone, ShippingMethod $method)
{
    $method->delete();
    return back()->with('success', 'Method deleted');
}

public function destroyLocation(ShippingZone $shippingZone, ShippingLocation $location)
{
    $location->delete();
    return back()->with('success', 'Location deleted');
}






 

}
