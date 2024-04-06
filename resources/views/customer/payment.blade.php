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
                                            <th scope="col">Pay Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td><input value="{{ $totalAmounts[$customers->id] ?? 0 }}" type="text" name="total_bills" class="form-control amount" readonly></td>
                                            <td><input value="1000" id="total_received" value="" type="text" name="total_received" class="form-control total_received" required></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b class="total"></b></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
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








 