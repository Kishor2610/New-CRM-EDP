@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Create Inovice</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Create Inovice</a></li>
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
                    <h3 class="tile-title">Invoice</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('invoice.store')}}">
                            @csrf
                            <div class="form-row">

                            <div class="form-group col-md-3">
                                <label class="control-label">Customer Name</label>
                                <select name="customer_id" class="form-control">
                                    <option>Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option name="customer_id" value="{{$customer->id}}">{{$customer->name}}  </option>
                                    @endforeach
                        
                                </select>  
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input name="date"  class="form-control datepicker" disabled  value="<?php echo date('Y-m-d')?>" type="date" placeholder="Enter your email">
                            </div>

                            </div>
                           



                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Amount</th>
                               
                                <th scope="col"><a class="btn btn-success addRow"><i class="fa fa-plus"></i></a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><select name="product_id[]" class="form-control productname" >
                                        <option>Select Product</option>
                                    @foreach($products as $product)
                                            <option name="product_id[]" value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select></td>
                                <td><input type="text" name="qty[]" class="form-control qty" ></td>
                                <td><input type="text" name="price[]" class="form-control price" ></td>
                                {{-- <td><input type="text" value="0" name="dis[]" class="form-control dis"></td> --}}

                                <td>
                                    <select name="dis[]" class="form-control dis">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="50">50%</option>
                                    </select>
                                </td>    

                                 
                                <td><input type="text" name="amount[]" class="form-control amount" ></td>

                                <td>                                       
                                    <a class="btn btn-danger remove"> <i class="fa fa-remove"></i></a>
                                </td>
                            
                             </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td> <b>Select Tax</b></td>
                                <td>
                                    <select name="tax_id[]" class="form-control tax_id">
                                        @foreach($taxes as $tax)
                                            @if($tax->slug != "Select Tax")
                                                <option value="{{$tax->slug}}">{{$tax->slug}}%</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                              
                                <td><b>Total</b></td>
                                    <td><input type="number" class="form-control total" name="total"></td>
                                <td></td>
                            </tr>
                            </tfoot>

                        </table>

                        <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
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
     <script src="{{asset('/')}}js/multifield/jquery.multifield.min.js"></script>

     



    <script type="text/javascript">
      
        $(document).ready(function(){

            $('tbody').delegate('.productname', 'change', function () {

                var  tr = $(this).parent().parent();
                tr.find('.qty').focus();

            })


            $('tbody').delegate('.productname', 'change', function () {

                var tr =$(this).parent().parent();
                var id = tr.find('.productname').val();
                var dataId = {'id':id};
                $.ajax({
                    type    : 'GET',
                    url     :'{!! URL::route('findPrice') !!}',

                    dataType: 'json',
                    data: {"_token": $('meta[name="csrf-token"]').attr('content'), 'id':id},
                    success:function (data) {
                        tr.find('.price').val(data.sales_price);
                    }
                });
            });

            
            $('tbody').delegate('.qty,.price,.dis', 'keyup change', function () {
                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var dis = tr.find('.dis').val();

                var amount = (qty * price) - (qty * price * (dis / 100));
                tr.find('.amount').val(amount);
                total();
            });
            


            $('tfoot').delegate('.tax_id','change',function(){
                var tr =$(this).parent().parent();
                tr.find('.tax_id').focus();
                total();

            });

                   
            function total(){
                var total = 0;
                var tax = 0;
                tax = $('.tax_id').val();

                if(tax > -10){
                    tax =parseInt(tax);
                }
                else (
                    tax =parseInt(0)
                )

                $('.amount').each(function (i,e) {
                    var amount =$(this).val()-0;
                  
                    total += amount;
                   
                })

                //total = parseInt(total);
                total +=  +(total) * +(+(tax)/100);
                
                total = parseInt(total);
            
                // $('.total').html(total);
                $('.total').val(total);
            }

                   
           

            $('.addRow').on('click', function () {
                addRow();

            });



            function addRow() {
                var addRow = '<tr>\n' +
                    '         <td><select name="product_id[]" class="form-control productname " >\n' +
                    '         <option value="0" selected="true" disabled="true">Select Product</option>\n' +
                    '                                        @foreach($products as $product)\n' +
                    '                                            <option value="{{$product->id}}">{{$product->name}}</option>\n' +
                    '                                        @endforeach\n' +
                    '               </select></td>\n' +
                    '                                <td><input type="text" name="qty[]" class="form-control qty" ></td>\n' +
                    '                                <td><input type="text" name="price[]" class="form-control price" ></td>\n' +
                    '                                <td><select name="dis[]" class="form-control dis">\n' +
                    '                                                <option value="0">0%</option>\n' +    
                    '                                                <option value="5">5%</option>\n' +
                    '                                                <option value="10">10%</option>\n' +
                    '                                                <option value="20">20%</option>\n' +
                    '                                                <option value="50">50%</option>\n' +
                    '                                            </select></td>\n' +
                    '                                <td><input type="text" name="amount[]" class="form-control amount" ></td>\n' +
                    '                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>\n' +
                    '                             </tr>';
                $('tbody').append(addRow);
            }


                


            $('.remove').live('click', function () {
                var l =$('tbody tr').length;
                if(l==1){
                    alert('you cant delete last one')
                }else{

                    $(this).parent().parent().remove();

                }

            });
        });


    </script>

@endpush



