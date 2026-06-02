<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterSetting;

class FooterController extends Controller
{
    public function edit()
    {
        $footer = FooterSetting::firstOrCreate([]);
        return view('admin.footer.edit', compact('footer'));
    }

  public function update(Request $request)
{
    $footer = FooterSetting::first();

    $footer->update([
        'footer_colunm1_headline' => $request->footer_colunm1_headline,
        'footer_colunm1' => $request->footer_colunm1 ?? [],

        'footer_colunm2_headline' => $request->footer_colunm2_headline,
        'footer_colunm2' => $request->footer_colunm2 ?? [],

        'footer_colunm3_headline' => $request->footer_colunm3_headline,
        'footer_colunm3' => $request->footer_colunm3 ?? [],

        'footer_colunm4_headline' => $request->footer_colunm4_headline,
        'footer_colunm4' => $request->footer_colunm4 ?? [],
    ]);

    return redirect()->route('admin.footer.edit')->with('success', 'Footer updated successfully!');
}

}
