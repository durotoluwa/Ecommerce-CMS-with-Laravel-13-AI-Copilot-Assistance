<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\menuitemdrag;

class MenuItemController extends Controller
{
   public function index()
    {
        $menuItems = menuitemdrag::where('menu', 'main_menu')
            ->whereNull('parent')
            ->orderBy('sort')
            ->with('children')
            ->get();

        return view('admin.menu.menu-builder', compact('menuItems'));
    }

    public function store(Request $request)
    {
        menuitemdrag::create([
            'label' => $request->label,
            'link' => $request->link,
            'sort' => menuitemdrag::max('sort') + 1,
        ]);

        return redirect()->back();
    }

 


    public function reorder(Request $request)
{
    foreach ($request->order as $item) {
        menuitemdrag::where('id', $item['id'])->update([
            'parent' => $item['parent'],
            'sort' => $item['sort'],
            'depth' => $item['parent'] ? menuitemdrag::find($item['parent'])->depth + 1 : 0
        ]);
    }

    return response()->json(['status' => 'success']);
}


public function destroy($id)
{
    $item = menuitemdrag::findOrFail($id);

    // Recursively delete children if needed
    foreach ($item->children as $child) {
        $child->delete();
    }

    $item->delete();

    return response()->json(['success' => true]);
}
}
