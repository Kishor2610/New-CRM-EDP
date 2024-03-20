<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\RawMaterial;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

   
    public function create()
    {
        $rawMaterials = RawMaterial::all();
        return view('supplier.create', compact('rawMaterials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:suppliers|regex:/^[a-zA-Z ]+$/',
            'address' => 'required|min:3',
            'mobile' => 'required|min:3|digits:10',
            'details' => 'required|string|min:1',
            'previous_balance' => 'min:3',

        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;

        $supplier->details = $request->input('details');
        $supplier->previous_balance = $request->previous_balance;
        $supplier->save();
       
        return redirect()->back()->with('message', 'Supplier Created Successfully');
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $rawMaterials = RawMaterial::all();
        return view('supplier.edit', compact('supplier','rawMaterials'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'address' => 'required|min:3',
            'mobile' => 'required|min:3|digits:10',
            'details' => 'required|min:3|',
            'previous_balance' => 'min:3',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;
        $supplier->details = $request->details;
        $supplier->previous_balance = $request->previous_balance;
        $supplier->save();

        return redirect()->back()->with('message', 'Suppler Updated Successfully');
    }

   
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back();

    }
}
