<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tags;

class productAttributeController extends Controller
{
   public function tagsPage()
   {
    $tags = tags::all();
    return view('admin.attribute.tags', compact('tags'));
   }
}
