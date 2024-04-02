<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Supplier;
use App\Tax;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $products = Product::all();
      
        $suppliers =Supplier::all();

        // dd($suppliers);

        return view('product.index', compact('products','suppliers'));
    }


    public function create()
    {
        $suppliers =Supplier::all();
        $categories = Category::all();
        $taxes = Tax::all();
        
        return view('product.create', compact('categories','taxes','suppliers'));
    }

    public function store(Request $request)
    {

         $request->validate([
            'name' => 'required|min:3|unique:products|regex:/^[a-zA-Z ]+$/',
            'serial_number' => 'required',
            'model' => 'required|min:3',
            'category_id' => 'required',
            'sales_price' => 'required',
            'product_qty' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tax_id' => 'required',

        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->model = $request->model;
        $product->category_id = $request->category_id;
        $product->sales_price = $request->sales_price;
        $product->product_qty = $request->product_qty;
        $product->unit_id = '0';
        $product->tax_id = $request->tax_id;


        if ($request->hasFile('image')){
            $imageName =request()->image->getClientOriginalName();
            request()->image->move(public_path('images/product/'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Created Successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $product =Product::findOrFail($id);
        $suppliers =Supplier::all();
        $categories = Category::all();
        $taxes = Tax::all();
        return view('product.edit', compact('suppliers','categories','taxes','product'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|unique:products|regex:/^[a-zA-Z ]+$/',
            'serial_number' => 'required',
            'model' => 'required|min:3',
            'category_id' => 'required',
            'sales_price' => 'required',
            'product_qty' => 'required',
            'unit_id' => '0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tax_id' => 'required',

        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->model = $request->model;
        $product->category_id = $request->category_id;
        $product->sales_price = $request->sales_price;
        $product->product_qty = $request->product_qty;
        $product->unit_id = '0';
        $product->tax_id = $request->tax_id;


        if ($request->hasFile('image')){
            $image_path ="images/product/".$product->image;
           
            // if (file_exists($image_path)){
            //     unlink($image_path);
            // }
            $imageName =request()->image->getClientOriginalName();
            request()->image->move(public_path('images/product/'), $imageName);
            $product->image = $imageName;
        }
        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }



    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();

    }


}
