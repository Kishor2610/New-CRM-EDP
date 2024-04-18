<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $taxes = Tax::all();
        return view('tax.index', compact('taxes'));
    }

 
    public function create()
    {
        return view('tax.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:taxes',
            'tax_value' => 'required|numeric',

        ]);


        $tax = new Tax();
               
        $tax->name = $request->name;
        $tax->slug = $request->tax_value;
        
        $tax->status = 1;

        $tax->save();

        return redirect()->back()->with('message', 'Tax Created Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('tax.edit', compact('tax'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',
            'tax_value' => 'required|numeric',
            // 'name' => 'required|numeric',
        ]);

        $tax = Tax::findOrFail($id);
        $tax->name = $request->name;
        $tax->slug = $request->tax_value;
        // $tax->slug = str_slug($request->name);
        $tax->save();

        return redirect()->back()->with('message', 'Tax Updated Successfully');
    }

    public function destroy($id)
    {
        $tax = Tax::find($id);
        $tax->delete();
        return redirect()->back();

    }
}
