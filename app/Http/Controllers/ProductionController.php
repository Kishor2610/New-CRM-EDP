<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Design;
use App\Production;

use Illuminate\Http\Request;

class ProductionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // Load designs with products eager loaded
        $designs = Design::with('product')->get();
    
        // Fetch all productions data
        $productions = Production::all();
        
        return view('production.index', compact('designs', 'productions'));
    }
    

    public function create(Request $request)
    {
        $orderId = $request->query('order_id');
        $design = Design::with('product')->where('order_id', $orderId)->first(); // Get the design for the specified order
        $products = Product::all(); // Fetch all products for dropdown
        $processes = explode(',', $design->process); // Assuming $design->process contains comma-separated processes

        
        return view('production.create', compact('design', 'products','processes'));
    }

    public function store(Request $request)
    {
    //  dd($request->all());

        $request->validate([
            'company_name' => 'required|min:3',
            'order_id' => 'required',
            'item_code' => 'required',
            'item_name' => 'required',
            'process' => 'required|array',
        ]);

        $production = new Production();
        $production->company_name = $request->company_name;
        $production->order_id = $request->order_id;
        $production->item_code = $request->item_code; // You might want to adjust this if it's dynamic
        $production->item_name = $request->item_name;
        $production->process = implode(',', $request->process); 
        $production->save();

        return redirect()->route('production.index')->with('message', 'Production Created Successfully')->with('refresh', true);
    }
  


}
