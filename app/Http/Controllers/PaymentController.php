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

        $request->validate([

            'total_received' => 'required|numeric',

        ]);

        $customer_id = $request->customer_id;

        $totalBills = $request->total_bills;
        $totalReceived = $request->total_received;
        $remainingBalance = $totalBills - $totalReceived;

      
        $payment = Payment::where('customer_id', $customer_id)->first();

        $previous_total_received = Payment::where('customer_id', $customer_id)->value('total_received');

        $previous_remaining_balance = Payment::where('customer_id', $customer_id)->value('remaining_balance');


        if ($payment) {
            // Update existing payment record
            $payment->total_bills = $totalBills;

            $payment->total_received = $totalReceived + $previous_total_received;
            
            $payment->remaining_balance = $totalBills -  $payment->total_received;
            

            if ($totalBills == $payment->total_received) 
            {
                $payment->payments_status = 'Paid'; 
            }
            else if($totalReceived == 0) 
            {
                $payment->payments_status = 'Unpaid';
            }
            else
            {
                $payment->payments_status = 'Pending'; 
            }
            
            $payment->save();
        } else {
            // Create new payment record
            $payment = new Payment();
            $payment->customer_id = $customer_id;
            $payment->total_bills = $totalBills;
            $payment->total_received = $totalReceived;
            $payment->remaining_balance = $remainingBalance;
            
            if ($totalBills == $payment->total_received) 
            {
                $payment->payments_status = 'Paid'; 
            }
            else if($totalReceived == 0) 
            {
                $payment->payments_status = 'Unpaid';
            }
            else
            {
                $payment->payments_status = 'Pending'; 
            }

            $payment->save();
        }


        return redirect()->back()->with('message', 'Payment has been successfully recorded.');
    }

   
    public function payment($id)
    {
        $customers = Customer::find($id);

        $payment = Payment::all();

        $totalBill = Payment::where('customer_id', $customers->id)->sum('total_bills');

        // dd($totalBill);

        $totalRemainingBalance = Payment::where('customer_id', $customers->id)->sum('remaining_balance');

        $totalReceived = Payment::where('customer_id', $customers->id)->sum('total_received');

        

        $payment = Payment::where('customer_id', $customers->id)->first();
        $payments_status = $payment ? $payment->payments_status : '';


        
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

        return view('customer.payment', compact('customers', 'totalAmounts', 'invoice','totalBill','totalRemainingBalance','totalReceived','payments_status'));
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
