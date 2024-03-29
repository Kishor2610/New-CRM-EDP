<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Quotation_sale;
use App\Tax;
use App\Supplier;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $quotations = Quotation::all();
        return view('quotation.index', compact('quotations'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $taxes = Tax::all();
        return view('quotation.create', compact('customers','products','taxes'));
    }

    
    public function store(Request $request)
    {
        $request->validate([

            'customer_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'dis' => 'required',
            'amount' => 'required',
            'tax_id'=> 'required',
        ]);

        $quotation = new Quotation();
        $quotation->customer_id = $request->customer_id;
        $quotation->tax = implode(',', $request->tax_id);
        $quotation->total = 1000;
        $quotation->save();

        foreach ( $request->product_id as $key => $product_id){
            $quotation_sale = new Quotation_sale();
            $quotation_sale->qty = $request->qty[$key];
                        
            $quotation_sale->price = $request->price[$key];
            $quotation_sale->dis = $request->dis[$key]; //discount
            
            $quotation_sale->amount = $request->amount[$key];

            $quotation_sale->product_id = $request->product_id[$key];
            $quotation_sale->quotation_id = $quotation->id;
            $quotation_sale->save();


         }

         return redirect('quotation/'.$quotation->id)->with('message','quotation created Successfully');




    }

    public function findPrice(Request $request){
        $data = DB::table('products')->select('sales_price')->where('id', $request->id)->first();
        return response()->json($data);
    }

    
    public function show($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation_sales = Quotation_sale::where('quotation_id', $id)->get();
        return view('quotation.show', compact('quotation','quotation_sales'));

    }

    
    public function edit($id)
    {
        $customers = Customer::all();
        $products = Product::orderBy('id', 'DESC')->get();
        $quotation = Quotation::findOrFail($id);
        $quotation_sales = Quotation_sale::where('quotation_id', $id)->get();
        $taxes = Tax::all();
        return view('quotation.edit', compact('customers','products','quotation','quotation_sales','taxes'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([

        'customer_id' => 'required',
        'product_id' => 'required',
        'qty' => 'required',
        'price' => 'required',
        'dis' => 'required',
        'amount' => 'required',
        'tax_id'=> 'required',

    ]);

        $quotation = Quotation::findOrFail($id);
        $quotation->customer_id = $request->customer_id;
        $quotation->total = 1000;
        $quotation->tax = implode(',', $request->tax_id);
        $quotation->save();

        Quotation_sale::where('quotation_id', $id)->delete();

        foreach ( $request->product_id as $key => $product_id){
            $quotation_sale = new Quotation_sale();
            $quotation_sale->qty = $request->qty[$key];
            $quotation_sale->price = $request->price[$key];
            $quotation_sale->dis = $request->dis[$key];  //discount
            $quotation_sale->amount = $request->amount[$key];
            $quotation_sale->product_id = $request->product_id[$key];
            $quotation_sale->quotation_id = $quotation->id;
            $quotation_sale->save();


        }

         return redirect('quotation/'.$quotation->id)->with('message','quotation created Successfully');


    }


    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
        return redirect()->back();

    }
    
}
