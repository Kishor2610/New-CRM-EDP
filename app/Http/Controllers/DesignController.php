<?php

namespace App\Http\Controllers;

use App\Order;
use App\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $orders = Order::all();

        
        $designs = Design::all();

        return view('design.index', compact('orders','designs'));
    }

    public function create(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::find($orderId);
        return view('design.create', compact('order'));
    }

    
    public function store(Request $request)
    {
            $request->validate([
                'company_name' => 'required|min:3',
                'po_number' => 'required',
                'order_id' => 'required',
                'item_code' => 'required',
                'qty' => 'required',
                'process' => 'required|array',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'remark' => 'nullable',
            ]);

            $design = new Design();
            $design->company_name = $request->company_name;
            $design->po_number = $request->po_number;
            $design->order_id = $request->order_id;
            $design->item_code = 000;
            $design->qty = 000;
            $design->process = implode(',', $request->process); // Convert array to comma-separated string
            $design->remark = $request->remark;

            if ($request->hasFile('image')) {
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('/images/design/'), $imageName);
                $design->image = $imageName;
            }

            $design->save();

         return redirect()->back()->with('message', 'Design Created Successfully');
    }





}
