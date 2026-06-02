<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\StoreBrand;



class MenuController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Menu List Page
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->orderBy('sort_order')
            ->with('children')
            ->get();

        return view('admin.menus.index', compact('menus'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store New Menu
    |--------------------------------------------------------------------------
    */
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'nullable|string|max:255',
        'parent_id' => 'nullable|exists:menus,id',
        'is_mega' => 'nullable|boolean',
        'mega_columns' => 'nullable|integer|min:1|max:12',
    ]);

    /*
    |--------------------------------------------------------------------------
    | CHECK MEGA MENU COLUMN LIMIT
    |--------------------------------------------------------------------------
    */

    if ($request->parent_id) {

        $parentMenu = Menu::find($request->parent_id);

        /*
        |--------------------------------------------------------------------------
        | IF PARENT IS MEGA MENU
        |--------------------------------------------------------------------------
        */

        if ($parentMenu && $parentMenu->is_mega) {

            $childrenCount = Menu::where(
                'parent_id',
                $parentMenu->id
            )->count();

            /*
            |--------------------------------------------------------------------------
            | LIMIT REACHED
            |--------------------------------------------------------------------------
            */

            if ($childrenCount >= $parentMenu->mega_columns) {

                return response()->json([
                    'status' => false,
                    'message' =>
                        'Maximum mega menu columns reached'
                ], 422);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE MENU INSTANCE
    |--------------------------------------------------------------------------
    */

    $menu = new Menu();

    $menu->title = $request->title;

    $menu->parent_id = $request->parent_id;

    $menu->is_mega = $request->is_mega ?? 0;

    $menu->mega_columns = $request->mega_columns ?? 4;

    $menu->sort_order = Menu::max('sort_order') + 1;

    /*
    |--------------------------------------------------------------------------
    | FIXED MENU
    |--------------------------------------------------------------------------
    */

    if ($request->type === 'fixed') {

        $fixedPages = [

            1 => route('cart.index'),

            2 => route('checkout.index'),

            3 => route('wishlist.index'),

            4 => route('myaccount.index'),

            5 => route('shop.index'),
        ];

        $menu->type = 'fixed';

        $menu->reference_id = $request->reference_id;

        $menu->url = $fixedPages[$request->reference_id] ?? null;

    } else {

        /*
        |--------------------------------------------------------------------------
        | EXISTING LOGIC
        |--------------------------------------------------------------------------
        */

        $menu->type = $request->type;

        $menu->reference_id = $request->reference_id;

        $menu->url = $request->type === 'custom'
            ? $request->url
            : null;
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE MENU
    |--------------------------------------------------------------------------
    */

    $menu->save();

    return response()->json([
        'status' => true,
        'message' => 'Menu created successfully',
    ]);
}
    /*
    |--------------------------------------------------------------------------
    | Update Menu
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'is_mega' => 'nullable|boolean',
            'mega_columns' => 'nullable|integer|min:1|max:12',
        ]);

        $menu->update([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'is_mega' => $request->is_mega ?? 0,
            'mega_columns' => $request->mega_columns ?? 4,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Menu updated successfully',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Menu
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        return response()->json([
            'status' => true,
            'message' => 'Menu deleted successfully',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Drag & Drop Sorting
    |--------------------------------------------------------------------------
    */
    public function sort(Request $request)
    {
        $menus = $request->menus;

        if (!$menus) {
            return response()->json([
                'status' => false,
                'message' => 'No menu data found',
            ]);
        }

        $this->updateMenuOrder($menus);

        return response()->json([
            'status' => true,
            'message' => 'Menu order updated',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Recursive Menu Sorting
    |--------------------------------------------------------------------------
    */
    private function updateMenuOrder($menus, $parentId = null)
    {
        foreach ($menus as $index => $menu) {

            Menu::where('id', $menu['id'])
                ->update([
                    'parent_id' => $parentId,
                    'sort_order' => $index,
                ]);

            if (isset($menu['children'])) {

                $this->updateMenuOrder(
                    $menu['children'],
                    $menu['id']
                );
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Menu Tree AJAX
    |--------------------------------------------------------------------------
    */
    public function tree()
    {
        $menus = Menu::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        return response()->json($menus);
    }
 


public function references($type)
{
    switch ($type) {
        case 'page':
            $items = \App\Models\Page::select('id', 'title as label')->get();
            break;

            
case 'fixed':
    $items = collect([
        ['id' => 1, 'label' => 'Cart',        'url' => route('cart.index')],
        ['id' => 2, 'label' => 'Checkout',    'url' => route('checkout.index')],
        ['id' => 3, 'label' => 'My Wishlist', 'url' => route('wishlist.index')],
        ['id' => 4, 'label' => 'My Account',  'url' => route('myaccount.index')],
        ['id' => 5, 'label' => 'Shop',        'url' => route('shop.index')],
    ]);
    break;



        case 'brand':
            $items = \App\Models\StoreBrand::select('id', 'name as label')->get();
            break;

case 'brand_category':
    $items = \App\Models\StoreBrand::all()->flatMap(function ($brand) {
        return \App\Models\ProductCategory::all()->map(function ($category) use ($brand) {
            return [
                'id' => $brand->id . '-' . $category->id, // composite key
                'label' => $brand->name . ' ' . $category->name,
                'brand_slug' => $brand->slug,
                'category_slug' => $category->slug,
            ];
        });
    });
    break;




        case 'product_category':
            $items = \App\Models\ProductCategory::select('id', 'name as label')->get();
            break;

        case 'product':
            $items = \App\Models\Product::select('id', 'name as label')->get();
            break;

        case 'blog_category':
            $items = \App\Models\BlogCategory::select('id', 'title as label')->get();
            break;

        default:
            $items = collect();
    }

    return response()->json($items);
}


}
