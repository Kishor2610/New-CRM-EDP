@extends('layouts.master')

@section('title', 'Design Data')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Design Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Design</a></li>
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
                        <h3>Design</h3>
                        <table class="table table-hover table-bordered" id="allData">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>PO Number</th>
                                    <th>Company Name</th>
                                    <th>Item Code</th>
                                    <th>Process</th>
                                    <th>Image</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->po_number }}</td>
                                        <td>{{ $order->company_name }}</td>
                                        @php $matchedDesign = $designs->where('order_id', $order->order_id)->first(); @endphp
                                        @if($matchedDesign)
                                            <td>{{ $matchedDesign->item_code }}</td>
                                            <td>{{ $matchedDesign->process }}</td>
                                            <td><img width="40 px" src="{{ asset('/images/design/'.$matchedDesign->image) }}"></td>
                                            <td>{{ $matchedDesign->remark }}</td>
                                        @else
                                            <td>N/A</td> 
                                            <td>N/A</td> 
                                            <td>N/A</td> 
                                            <td>N/A</td> 
                                        @endif
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('design.create', ['order_id' => $order->id]) }}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </td>
                                    </tr>
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
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#allData').DataTable();
        });
    </script>
@endpush
