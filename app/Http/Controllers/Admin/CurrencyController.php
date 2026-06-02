<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
  
public function index()
    {
        $currencies = Currency::all();
        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:currencies,code',
            'name' => 'required|string|max:255',
            'symbol' => 'nullable|string|max:5',
            'rate' => 'required|numeric|min:0',
           'is_base' => 'boolean',
            'is_display' => 'boolean',
        ]);

        // If setting base currency, unset others
        if ($request->is_base) {
            Currency::where('is_base', true)->update(['is_base' => false]);
        }

        Currency::create($request->all());

        return redirect()->route('admin.currencies.index')->with('success', 'Currency created successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

  public function update(Request $request, Currency $currency)
{
    $request->validate([
        'code' => 'required|string|max:10|unique:currencies,code,' . $currency->id,
        'name' => 'required|string|max:255',
        'symbol' => 'nullable|string|max:5',
        'rate' => 'required|numeric|min:0',
        'is_base' => 'boolean',
        'is_display' => 'boolean',
    ]);

    // If setting base currency, unset others
    if ($request->boolean('is_base')) {
        Currency::where('is_base', true)->update(['is_base' => false]);
    }

    // If setting display currency, unset others
    if ($request->boolean('is_display')) {
        Currency::where('is_display', true)->update(['is_display' => false]);
    }

    $currency->update([
        'code' => $request->code,
        'name' => $request->name,
        'symbol' => $request->symbol,
        'rate' => $request->rate,
        'is_base' => $request->boolean('is_base'),
        'is_display' => $request->boolean('is_display'),
    ]);

    return redirect()->route('admin.currencies.index')->with('success', 'Currency updated successfully.');
}


    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('admin.currencies.index')->with('success', 'Currency deleted successfully.');
    }
}
