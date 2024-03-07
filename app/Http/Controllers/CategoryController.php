<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories|regex:/^[a-zA-Z ]+$/',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->status = 1;
        $category->save();

        return redirect()->back()->with('message', 'Category Created Successfully');
    }

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $request->status;
        $category->save();
  
        return redirect()->back()->with('message', 'Status change successfully');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();

        return redirect()->back()->with('message', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();

    }
}
