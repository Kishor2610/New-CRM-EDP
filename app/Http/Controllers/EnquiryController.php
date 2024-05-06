<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Enquiry;
use App\Customer;
use App\Quotation;



class EnquiryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $enquiries = Enquiry::all(); 
        return view('enquiry.index', compact('enquiries')); 
    
    }

    
    public function create()
    {
        $products = Product::all(); 
        return view('enquiry.create',compact('products'));
    }

    public function store_data(Request $request)
    {

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'item' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'enquiry_source' => 'required|string|max:255',
            'description' => 'required|string',
            'customer_specification' => 'required|string',
        ]);

        $selectedItem = $validatedData['item'] === 'other' ? $request->other_item : $validatedData['item'];
    
        $enquiry = new Enquiry;
        $enquiry->company_name = $validatedData['company_name'];
        $enquiry->mobile = $validatedData['mobile'];
        $enquiry->email = $validatedData['email'];
        $enquiry->item = $selectedItem;
        $enquiry->qty = $validatedData['qty'];
        $enquiry->enquiry_source = $validatedData['enquiry_source'];
        $enquiry->description = $validatedData['description'];
        $enquiry->customer_specification = $validatedData['customer_specification'];
        $enquiry->comment="";
        $enquiry->status="New";
        $enquiry->save();

        return redirect()->back()->with('message', 'Enquiry added Successfully');

    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $products = Product::all(); 
        return view('enquiry.edit', compact('enquiry','products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'item' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'enquiry_source' => 'required|string|max:255',
            'description' => 'required|string',
            'customer_specification' => 'required|string',
        ]);

        $selectedItem = $request['item'] === 'other' ? $request->other_item : $request['item'];

        $enquiry = Enquiry::findOrFail($id);
        $enquiry->company_name = $request->company_name;
        $enquiry->mobile = $request->mobile;
        $enquiry->email = $request->email;
        $enquiry->item = $selectedItem;
        $enquiry->qty = $request->qty;
        $enquiry->enquiry_source = $request->enquiry_source;
        $enquiry->description = $request->description;
        $enquiry->customer_specification = $request->customer_specification;
        // $enquiry->comment="";
        // $enquiry->status="0";
        $enquiry->save();

        return redirect()->back()->with('message', 'Enquiry Updated Successfully');
    }



    public function destroy($id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->delete();
        
        return redirect()->back()->with('message', 'Enquiry Deleted Successfully');
    }


    public function changeStatus(Request $request)
    {

        $enquiry = Enquiry::findOrFail($request->enquiry_id);

        // if ($request->status == 3) {
        //     // Create a new customer record
        //     $customer = new Customer;
        //     $customer->name = $enquiry->company_name;
        //     $customer->email = $enquiry->email;
        //     $customer->mobile = $enquiry->mobile;

        //     $customer->address = "";
        //     $customer->details = "";
        //     $customer->previous_balance = "0";
        //     $customer->save();


        //     $quotation = new Quotation();
        //     $quotation->customer_id = "2";
        //     $quotation->tax = '0';
        //     $quotation->total = '0';
        //     $quotation->save();


                
            // Optionally, you can copy other fields from the enquiry to the customer here
            // $customer->some_field = $enquiry->some_field;
    
            // Delete the enquiry record
            // $enquiry->delete();

        // }


        if ($request->status == 3) {
            // Check if customer with the same email already exists
            $existingCustomer = Customer::where('email', $enquiry->email)->first();
        
            if (!$existingCustomer) {
                // Create a new customer record
                $customer = new Customer;
                $customer->name = $enquiry->company_name;
                $customer->email = $enquiry->email;
                $customer->mobile = $enquiry->mobile;
                $customer->address = "";
                $customer->details = "";
                $customer->previous_balance = "0";
                $customer->save();
            } else {
                // Update existing customer details if necessary
                $existingCustomer->name = $enquiry->company_name;
                // Update other fields as needed
                $existingCustomer->save();
                $customer = $existingCustomer;
            }
        
            // Create a new quotation record
            $quotation = new Quotation();
            $quotation->customer_id = $customer->id; // Use the existing or newly created customer's ID
            $quotation->tax = '0';
            $quotation->total = '0';
            $quotation->save();

        }


        $enquiry->status = $request->status;
        $enquiry->comment = $request->comment;
        $enquiry->save();

        return redirect()->back()->with('message', 'Enquiry status updated successfully.');
    }


 
 
}
