<?php

namespace App\Http\Controllers;
use App\Order;
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
        $orders = Order::all(); // Fetch all orders data
        
        $designs = Design::all(); // Fetch all designs data
    
        $productions = Production::all(); // Fetch all productions data
    
        return view('design.index', compact('orders', 'designs', 'productions')); // Pass orders, designs, and productions data to the view
    }
    

    public function create(Request $request)
    {
        $orderId = $request->query('order_id');
        $production = Production::find($orderId);
        return view('production.create', compact('design'));
    }

    
    public function store(Request $request)
    {
            $request->validate([
                'company_name' => 'required|min:3',
                // 'po_number' => 'required',
                'order_id' => 'required',
                'item_code' => 'required',
                // 'qty' => 'required',
                'process' => 'required|array',
                
                // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'remark' => 'nullable',
            ]);

            $production = new Production();
            $production->company_name = $request->company_name;
            // $production->po_number = $request->po_number;
            $production->order_id = $request->order_id;
            $production->item_code = 000;
            // $production->qty = 000;
             $production->process = implode(',', $request->process); 
            // $production->remark = $request->remark;

            // if ($request->hasFile('image')) {
            //     $imageName = $request->image->getClientOriginalName();
            //     $request->image->move(public_path('/images/design/'), $imageName);
            //     $design->image = $imageName;
            // }

            $production->save();

         return redirect()->back()->with('message', 'Production Created Successfully');
    }

  


}
