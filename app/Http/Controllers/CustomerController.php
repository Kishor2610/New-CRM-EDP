<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
        public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|min:3|unique:customers|regex:/^[a-zA-Z ]+$/',
        'address' => 'required|min:3',
        'mobile' => 'required|min:3|digits:10',
        'details' => 'required|min:3|',
        'previous_balance' => 'min:2',

        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->details = $request->details;
        $customer->previous_balance = $request->previous_balance;
        $customer->save();

        return redirect()->back()->with('message', 'Customer Created Successfully');
    }

  
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
        'address' => 'required|min:3',
        'mobile' => 'required|min:3|digits:10',
        'details' => 'required|min:3|',
        'previous_balance' => 'min:2',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->details = $request->details;
        $customer->previous_balance = $request->previous_balance;
        $customer->save();

        return redirect()->back()->with('message', 'Customer Updated Successfully');
    }


    public function destroy($id)
    {
    $customer = Customer::find($id);
    $customer->delete();
    // return redirect()->back();
    
    return redirect()->back()->with('message', 'Customer Deleted Successfully');
    }



    

    


}



