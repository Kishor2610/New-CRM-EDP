<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Sale;
use App\Payment;
use App\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('customer.payment');
    }


    public function store(Request $request)
    { 
        $url = $request->session()->get('_previous')['url']; // Get the URL from the session
        $segments = explode('/', $url); // Split the URL into segments
        $invoiceId = end($segments); 
        
        $customerId = $request->customer_id;
        $previous_total_received = Payment::where('customer_id', $customerId)
                                    ->where('invoice_id', $invoiceId)->value('total_received');

        $totalReceived = $request->total_received + $previous_total_received;
        $totalBills = $request->total_bills;
       
        $paymentStatus = ($totalReceived == $totalBills) ? 'Paid' : (($totalReceived > 0) ? 'Pending' : ($request->payments_status ?? 'Unpaid'));

        $paymentData = [
            'customer_id' => $customerId,
            'total_bills' => $request->total_bills,
            'total_received' => $request->total_received + $previous_total_received,
            'remaining_balance' => $request->total_bills - ($request->total_received + $previous_total_received),
            'payments_status' => $paymentStatus,

        ];
       
        // Check if the payment record already exists for the invoice ID
        $payment = Payment::where('customer_id', $customerId)
                        ->where('invoice_id', $invoiceId)
                        ->first();

        if ($payment) 
        {                            
                $payment->update($paymentData);    // If the payment record exists, update it with the new data
        
        } else 
        {
            Payment::create(array_merge(['invoice_id' => $invoiceId], $paymentData));   // If the payment record doesn't exist, create a new one
        }

        return redirect()->back()->with('message', 'Payment has been successfully recorded.');
}



// Data Pass To Create payment  blade

    public function payment($id)
    {
        
        $invoices = Invoice::find($id);
        $invoiceId = $invoices->id;
        
        $customerId = Invoice::where('Id', $invoiceId)->value('customer_id');

        $customers = Customer::find($customerId);

        $payment = Payment::all();
       
       
        $totalBill = Invoice::where('customer_id', $customerId)
                    ->where('id', $invoiceId)
                    ->value('total');
        
       
        $totalReceived = Payment::where('customer_id', $customerId)
                                ->where('invoice_id', $invoiceId)->value('total_received');
        
                                
        $totalRemainingBalance = Payment::where('customer_id', $customerId)
                                        ->where('invoice_id', $invoiceId)
                                        ->value('remaining_balance');
      
        
        $payments_status = Payment::where('customer_id', $customerId)
                                        ->where('invoice_id', $invoiceId)
                                        ->value('payments_status');
      

        return view('customer.payment', compact('customers','invoiceId','totalBill','totalRemainingBalance','totalReceived','payments_status'));
    }



// Pie chart
    public function getCustomerPayments($customerId)
    {
        $totalBill = 0;
        $remainingBill = 0;

        
        $payments = Payment::where('customer_id', $customerId)->get();

        foreach ($payments as $payment) {
            $totalBill += $payment->total_bills;
            $remainingBill += $payment->remaining_balance;
        }

        $payments2 = Payment::all();
    
        return response()->json(['totalBill' => $totalBill, 
                            'remainingBill' => $remainingBill,
                            'payments' => $payments2
                        ]);
    }
   
}
