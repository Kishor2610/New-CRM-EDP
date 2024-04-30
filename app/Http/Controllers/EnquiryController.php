<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enquiry;



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
        return view('enquiry.create');
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
    
        $enquiry = new Enquiry;
        $enquiry->company_name = $validatedData['company_name'];
        $enquiry->mobile = $validatedData['mobile'];
        $enquiry->email = $validatedData['email'];
        $enquiry->item = $validatedData['item'];
        $enquiry->qty = $validatedData['qty'];
        $enquiry->enquiry_source = $validatedData['enquiry_source'];
        $enquiry->description = $validatedData['description'];
        $enquiry->customer_specification = $validatedData['customer_specification'];
        $enquiry->comment="";
        $enquiry->status="0";
        $enquiry->save();

        return redirect()->back()->with('message', 'Enquiry added Successfully');

    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('enquiry.edit', compact('enquiry'));
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

        $enquiry = Enquiry::findOrFail($id);
        $enquiry->company_name = $request->company_name;
        $enquiry->mobile = $request->mobile;
        $enquiry->email = $request->email;
        $enquiry->item = $request->item;
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
        $enquiry->status = $request->status;
        $enquiry->comment = $request->comment;
        $enquiry->save();

        return redirect()->back()->with('message', 'Enquiry status updated successfully.');
    }


 
 
}
