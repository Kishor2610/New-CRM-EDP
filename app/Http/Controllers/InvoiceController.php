<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Sale;
use App\Tax;
use App\Supplier;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $taxes = Tax::all();
        return view('invoice.create', compact('customers','products','taxes'));
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

        $invoice = new Invoice();
        $invoice->customer_id = $request->customer_id;
        $invoice->tax = implode(',', $request->tax_id);
        $invoice->total = 1000;
        $invoice->save();

        foreach ( $request->product_id as $key => $product_id){
            $sale = new Sale();
            $sale->qty = $request->qty[$key];
                        
            $sale->price = $request->price[$key];
            $sale->dis = $request->dis[$key];
            
            $sale->amount = $request->amount[$key];

            $sale->product_id = $request->product_id[$key];
            $sale->invoice_id = $invoice->id;
            $sale->save();


         }

         return redirect('invoice/'.$invoice->id)->with('message','invoice created Successfully');




    }

    public function findPrice(Request $request){
        $data = DB::table('products')->select('sales_price')->where('id', $request->id)->first();
        return response()->json($data);
    }

    
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $sales = Sale::where('invoice_id', $id)->get();
        return view('invoice.show', compact('invoice','sales'));

    }

    
    public function edit($id)
    {
        $customers = Customer::all();
        $products = Product::orderBy('id', 'DESC')->get();
        $invoice = Invoice::findOrFail($id);
        $sales = Sale::where('invoice_id', $id)->get();
        $taxes = Tax::all();
        return view('invoice.edit', compact('customers','products','invoice','sales','taxes'));
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

        $invoice = Invoice::findOrFail($id);
        $invoice->customer_id = $request->customer_id;
        $invoice->total = 1000;
        $invoice->tax = implode(',', $request->tax_id);
        $invoice->save();

        Sale::where('invoice_id', $id)->delete();

        foreach ( $request->product_id as $key => $product_id){
            $sale = new Sale();
            $sale->qty = $request->qty[$key];
            $sale->price = $request->price[$key];
            $sale->dis = $request->dis[$key];
            $sale->amount = $request->amount[$key];
            $sale->product_id = $request->product_id[$key];
            $sale->invoice_id = $invoice->id;
            $sale->save();


        }

         return redirect('invoice/'.$invoice->id)->with('message','invoice created Successfully');


    }


    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->back();

    }


    public function sales()
    {
        $invoices = Invoice::with('sales.product')->get();
    
        $sales = collect();
        foreach ($invoices as $invoice) {
            $sales = $sales->merge($invoice->sales);
        }

        return view('invoice.sales', compact('invoices','sales'));
    }

    

    
}
