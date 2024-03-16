<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RawMaterial;

class RawMaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $raw_material = RawMaterial::all();
        return view('raw_material.index', compact('raw_material'));
    }

    public function create()
    {
        return view('raw_material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_name' => 'required|min:3|unique:raw_material|regex:/^[a-zA-Z ]+$/',
        ]);

        $raw_material = new RawMaterial();
        $raw_material->material_name = $request->material_name;
        $raw_material->status = 1;
        $raw_material->save();

        return redirect()->back()->with('message', 'Raw Material Created Successfully');
    }

    public function changeStatus(Request $request)
    {
        $raw_material = RawMaterial::find($request->id);
        $raw_material->status = $request->status;
        $raw_material->save();
  
        return redirect()->back()->with('message', 'Status change successfully');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $raw_material = RawMaterial::findOrFail($id);
        return view('raw_material.edit', compact('raw_material'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'material_name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
        ]);

        $raw_material = RawMaterial::findOrFail($id);
        $raw_material->material_name = $request->material_name;
        $raw_material->save();

        return redirect()->back()->with('message', 'Raw Material Updated Successfully');
    }

    public function destroy($id)
    {
        $RawMaterial = RawMaterial::find($id);
        $RawMaterial->delete();
        return redirect()->back();

    }

    
}
