<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Quotation_sale;
use App\Payment;
use App\Invoice;
use App\Quotation;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
        public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $quotations = Quotation::where('status', 3)->get();
        $matchedQuotationSales = [];
        $customerNamesByQuotationId = [];

        foreach ($quotations as $quotation) {
            $quotationSales = Quotation_sale::where('quotation_id', $quotation->id)->get();

            $customer = Customer::find($quotation->customer_id); 
            foreach ($quotationSales as $quotationSale) {
                $quotationSale['customer_name'] = $customer ? $customer->name : ''; 
                $customerName = $customer ? $customer->name : '';
                $customerNamesByQuotationId[$quotation->id][] = $customerName;
            }

            $matchedQuotationSales = array_merge($matchedQuotationSales, $quotationSales->toArray());
        }

        // dd($customerNamesByQuotationId);


        // $organizedData = [];
        // foreach ($matchedQuotationSales as $quotationSale) {
        //     $quotationId = $quotationSale['quotation_id'];
 
        //     $customer = Customer::find($quotation->customer_id); 
        //     if (!isset($organizedData[$quotationId])) {
        //         $organizedData[$quotationId] = [
        //             'products' => [],
        //             'customer_id' => $customer 
        //         ];
        //     }

        //     $organizedData[$quotationId]['products'][] = [
        //         'product_id' => $quotationSale['product_id'],
        //         'qty' => $quotationSale['qty'],
        //         'amount' => $quotationSale['amount']
        //     ];
        // }

        // dd($organizedData);


        $organizedData = [];
        foreach ($matchedQuotationSales as $quotationSale) {
            $quotationId = $quotationSale['quotation_id'];
        
            // Fetch the quotation details
            $quotation = Quotation::find($quotationId);
        
            // Check if quotation exists
            if ($quotation) {
                // Fetch the total value for the quotation
                $totalValue = $quotation->total;
        
                // Fetch the customer details
                $customer = Customer::find($quotation->customer_id);
        
                if (!isset($organizedData[$quotationId])) {
                    $organizedData[$quotationId] = [
                        'products' => [],
                        'customer_id' => $customer,
                        'total_value' => $totalValue
                    ];
                }
        
                $organizedData[$quotationId]['products'][] = [
                    'product_id' => $quotationSale['product_id'],
                    'qty' => $quotationSale['qty'],
                    'amount' => $quotationSale['amount'],
                    'total_value' => $totalValue
                ];
            }
        }
        
        // dd($organizedData);
        





        $orders = Order::all();
        return view('order.index', compact('orders','matchedQuotationSales','organizedData','productName','customerNamesByQuotationId'));
    }





    public function create($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);

        $companyName = $quotation->customer->name;
        $companyMobile = $quotation->customer->mobile;
        $companyEmail = $quotation->customer->email;
        $total = $quotation->total;
    

        $quotation_sales = Quotation_sale::where('quotation_id', $quotationId)->get();
        $productIds = []; 
                foreach ($quotation_sales as $quotation_sale) 
                {
                    $productId = $quotation_sale->product_id;
           
                    if (!in_array($productId, $productIds)) {
                        $productIds[] = $productId;
                    }
                }
        $products = Product::whereIn('id', $productIds)->pluck('name', 'id');

        return view('order.create', compact('products','companyName','companyMobile','companyEmail','quotationId','total'));
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'company_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // 'item' => 'required|exists:products,id',
            'item' => 'required|array',
            'item.*' => 'required|exists:products,id',
            'total' => 'required|numeric',
            'po_number' => 'nullable|string|max:255',
            'expected_delivery' => 'required|date', 
            'comment' => 'nullable|string',
        ]);

        $items = implode(',', $validatedData['item']);

        // dd($items);
        $order = new Order;
        $order->order_id = $validatedData['quotation_id']; 
        $order->company_name = $validatedData['company_name'];
        $order->mobile = $validatedData['mobile'];
        $order->email = $validatedData['email'];
        $order->item = $items;
        $order->total = $validatedData['total']; 
        $order->po_number = $validatedData['po_number'];
        $order->status = 1;
        $order->expected_delivery = $validatedData['expected_delivery'];
        $order->comment = $validatedData['comment'];
        $order->save();

        return redirect()->back()->with('message', 'Order added Successfully');
    }

  
}



