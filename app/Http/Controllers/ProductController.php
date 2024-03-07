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
        
        return view('product.index', compact('products'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tax_id' => 'required',

        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->model = $request->model;
        $product->category_id = $request->category_id;
        $product->sales_price = $request->sales_price;
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


}
