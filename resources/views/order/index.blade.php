@extends('layouts.master')

@section('title', 'Order | ')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Order Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Order</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif


        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr style="vertical-align: middle; text-align:center">
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    {{-- <th>Expected Delivery</th>
                                    <th>Status</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($organizedData as $quotationId => $data)
                                    
                                    @php
                                            $uniqueCustomerNames = array_unique($customerNamesByQuotationId[$quotationId]);
                                    @endphp
                                    
                                    @foreach ($data['products'] as $index => $product)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align:center">{{ $quotationId }}</td>
                                            @endif
    
                                            @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align:center">
                                                @foreach ($uniqueCustomerNames as $customerName)
                                                    {{ $customerName }}
                                                    @if (!$loop->last)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            @endif

                                        
                                            <td  style="vertical-align: middle; text-align:center">
                                                {{ App\Product::find($product['product_id'])->name }}
                                            </td>

                                            <td  style="vertical-align: middle; text-align:center">
                                                {{ $product['qty'] }}
                                            </td>


                                            @if ($index === 0)
                                                <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align:center">{{ $product['total_value'] }}</td>
                                             @endif
                                          
                                            
                                            {{-- @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align: center"> 14/2/2024</td>
                                            @endif --}}
                                            
                                            {{-- @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle;">New</td>
                                            @endif --}}

                                            @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align:center">

                                                <a class="btn btn-primary" href="{{ route('order.create', ['quotation_id' => $quotationId]) }}">
                                                    <i class="fa fa-payment"></i> Place Order
                                                </a>
                                        

                                             </td>

                                            @endif

                                        </tr>
                                    @endforeach 
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>


    
@endpush