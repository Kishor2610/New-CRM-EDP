@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus"></i> Create Invoice </h1>

            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i href="#" class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            </ul>
        </div>


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Invoice</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('invoice.store')}}">
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">Customer Name</label>
                                <select name="customer_id" class="form-control">
                                    <option>Select Customer</option>
                                    <option name="customer_id" value="Yash Dhage" >Yash Dhage</option>
                                    <option name="customer_id" value="Raj Dhage" >Raj Dhage</option>
                                </select>                            
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input name="date"  class="form-control datepicker"  value="<?php echo date('Y-m-d')?>" type="date" placeholder="Enter your email">
                            </div>



                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Amount</th>
                                <th scope="col"><a class="addRow"><i class="fa fa-plus"></i></a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><select name="product_id[]" class="form-control productname" >
                                        <option>Select Product</option>
                                        <option name="product_id[]" value="Apple">Apple</option>
                                        <option name="product_id[]" value="Redmi">Redmi</option>
                                    </select></td>
                                <td><input type="text" name="qty[]" class="form-control qty" ></td>
                                <td><input type="text" name="price[]" class="form-control price" ></td>
                                <td><input type="text" name="dis[]" class="form-control dis" ></td>
                                <td><input type="text" name="amount[]" class="form-control amount" ></td>
                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>
                             </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total</b></td>
                                <td><b class="total"></b></td>
                                <td></td>
                            </tr>
                            </tfoot>

                        </table>

                            <div >
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                     </form>
                    </div>
                </div>


                </div>
            </div>
    </main>

@endsection


