<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $customers = Customer::all();
        return view('invoice.create', compact('customers'));
    }

   
    public function store(Request $request)
    {
        
    }
   


    
}
