@extends('layouts.master')

@section('title', 'Payment | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Make Payment </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Make Payment</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Make Payment</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{ route('customer.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Customer Name</label>
                                        <input value="{{ $customers->name }}" type="text" name="customer_id" class="form-control name" disabled>
                                        <input value="{{ $customers->id }}" type="hidden" name="customer_id">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Date</label>
                                        <input name="date" class="form-control datepicker" value="<?php echo date('Y-m-d')?>" type="date" placeholder="Enter your email">
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Total Received</th>
                                            <th scope="col">Pay Amount</th>
                                            <th scope="col">Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td>
                                                @if($payments_status === 'Paid')
                                                    <input value="{{ $totalBill }}" type="text" name="total_bills" class="form-control amount" readonly></td>
                                                @else  
                                                     <input value="{{ $totalBill}}" type="text" name="total_bills" class="form-control amount" readonly></td>
                                                @endif
                                            
                                            <td>
                                                <input  id="total_received2" value="{{$totalReceived}}" type="text" name="total_received2" class="form-control total_received" required disabled>    
                                            </td>

                                            
                                            <td>
                                                @if($payments_status === 'Paid') 
                                                    <input  id="total_received" value="" type="text" name="total_received" class="form-control total_received" required disabled>
                                                @else
                                                    <input id="total_received" value="{{$totalRemainingBalance}}" type="text" name="total_received" class="form-control total_received" required>
                                                    @endif
                                            </td>
                                               
                                        
                                            <td><button class="btn
                                                    @if($payments_status === 'Paid')
                                                        btn-success
                                                    @elseif($payments_status === 'Unpaid')
                                                        btn-danger
                                                    @elseif($payments_status === 'Pending')
                                                        btn-warning
                                                    @endif" 

                                                    disabled>{{ $payments_status }}    
                                            
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">Make Payment</button>
                                </div>
                            </form>                            
                    </div>
                </div>

                </div>
            </div>
    </main>





    @endsection

@push('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>


    
    <script>

        document.getElementById('customer_name').addEventListener('change', function () {
            var customerId = this.value;
            var totalAmount = {{ $totalAmounts[$invoice->customer_id] ?? 0 }};
            document.getElementById('total_amount').value = totalAmount;
        });
    </script>

    


@endpush



