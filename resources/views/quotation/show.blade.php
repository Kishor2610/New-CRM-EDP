@extends('layouts.master')

@section('title', 'Quotation | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Quotation</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Quotation</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="quotation">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"> EDHAAS DIGISOFT PRIVATE LIMITED</h2>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <h5 class="text">Quotation #{{1000+$quotation->id}}</h5>
                            </div>
                            <div class="col-6">
                                <h5 class="text">Date: {{$quotation->created_at->format('Y-m-d')}}</h5>
                            </div>
                        </div>
                        <div class="row quotation-info">
                            <div class="col-6">From
                                <address><strong>EDHAAS DIGISOFT PRIVATE LIMITED</strong><br>Pune<br>Maharastra<br>Email: contact@edhaasdigisoft.com</address>
                            </div>
                            <div class="col-6">To
                                 <address><strong>{{$quotation->customer->name}}</strong><br>{{$quotation->customer->address}}<br>Phone: {{$quotation->customer->mobile}}<br>Email: {{$quotation->customer->email}}</address>
                             </div>
                            {{--<div class="col-4"><b>Quotation #{{1000+$quotation->id}}</b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> {{$quotation->created_at->format('Y-m-d')}}<br><b>Account:</b> 968-34567</div>--}}
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$total=0}}
                                    </div>
                                    @foreach($quotation_sales as $quotation_sale)
                                    <tr>
                                        <td>{{$quotation_sale->product->name}}</td>
                                        <td>{{$quotation_sale->price}}</td>
                                        <td>{{$quotation_sale->qty}}</td>
                                        <td>{{$quotation_sale->amount}}</td>
                                        <div style="display: none">
                                            {{$total +=$quotation_sale->amount}}
                                        </div>
                                     </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td><b>Tax</b></td>
                                        <td><b class="tax_id">{{ $quotation->tax }}%</b></td>
                                    </tr>
                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total">{{$total}}</b></td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row mb-4 row-bordered " style="border-top: 1px solid #dee2e6;border-bottom: 1px solid #dee2e6;
                            padding-top: 10px;padding-bottom: 5px;margin-left: 2px;margin-right: 2px;">
                            <div class="col-5">
                                <h5 class="page-footer"> If you accept this quotation kindly sign and return:</h5>
                            </div>

                            <div class="col-7">
                                <h5 class="page-footer text-left">(Signature)</h5>
                            </div>
                        </div>

                        <div class="text-center">
                            <h5>THANK YOU FOR BUSINESS!</h5>
                        </div>

                       <div class="row d-print-none mt-2">
                            <div class="col-11 text-right">
                                <a class="btn btn-primary" href="javascript:window.print();">
                                    <i class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>


                    
                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('js')
@endpush


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    document.getElementById("print-pdf-btn").addEventListener("click", function() {
        var doc = new jsPDF();
        doc.text(20, 20, 'This is a sample PDF generated using jsPDF!');
        doc.save('sample.pdf');
    });
</script>





