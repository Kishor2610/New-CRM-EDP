@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                
                                {{-- <h2 class="page-header"><i class="fa fa-globe"></i> EDHAAS DIGISOFT PRIVATE LIMITED</h2> --}}
                                <h2 class="page-header"> EDHAAS DIGISOFT PRIVATE LIMITED</h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{$invoice->created_at->format('Y-m-d')}}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">From
                                <address><strong>EDHAAS DIGISOFT PRIVATE LIMITED</strong><br>Pune<br>Maharastra<br>Email: contact@edhaasdigisoft.com</address>
                            </div>
                            <div class="col-4">To
                                 <address><strong>{{$invoice->customer->name}}</strong><br>{{$invoice->customer->address}}<br>Phone: {{$invoice->customer->mobile}}<br>Email: {{$invoice->customer->email}}</address>
                             </div>
                            <div class="col-4"><b>Invoice #{{1000+$invoice->id}}</b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> {{$invoice->created_at->format('Y-m-d')}}<br><b>Account:</b> 968-34567</div>
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
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$sale->product->name}}</td>
                                        <td>{{$sale->price}}</td>
                                        <td>{{$sale->qty}}</td>
                                        <td>{{$sale->amount}}</td>
                                        <div style="display: none">
                                            {{$total +=$sale->amount}}
                                        </div>
                                     </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td><b>Tax</b></td>
                                        <td><b class="tax_id">{{ $invoice->tax }}%</b></td>
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
                        
                        {{-- <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <a class="btn btn-primary" href="javascript:window.open('about:blank').document.body.innerHTML = document.body.innerHTML; window.print();">
                                    <i class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>
                         --}}


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





