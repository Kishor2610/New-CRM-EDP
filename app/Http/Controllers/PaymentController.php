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

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id', 
            'total_received' => 'required|numeric|min:0', 
        ]);

        // Calculate remaining balance
        $totalBills = $request->input('total_bills');
        $totalReceived = $request->input('total_received');
        $remainingBalance = $totalBills - $totalReceived;

        // Create a new payment record
        $payment = new Payment();
        $payment->customer_id = $validatedData['customer_id'];
        $payment->total_bills = $totalBills;
        $payment->total_received = $totalReceived;
        $payment->remaining_balance = $remainingBalance;
        $payment->payments_status = ($remainingBalance <= 0) ? 'Paid' : 'Pending'; // Determine payment status
        
                
        $payment->save();

        return redirect()->back()->with('success', 'Payment has been successfully recorded.');
    }


    public function payment($id)
    {
        $customers = Customer::find($id);
        $invoices = Invoice::all();
        $totalAmounts = [];

        foreach ($invoices as $invoice) {
            $customerId = $invoice->customer_id;
            $totalAmount = (float)$invoice->total;

            if (isset($totalAmounts[$customerId])) {
                $totalAmounts[$customerId] += $totalAmount;
            } else { 
                $totalAmounts[$customerId] = $totalAmount;
            }
        }
       
        return view('customer.payment', compact('id','customers', 'totalAmounts', 'invoice'));
    }


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
