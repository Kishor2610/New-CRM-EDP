<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Sale;
use App\Payment;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

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
