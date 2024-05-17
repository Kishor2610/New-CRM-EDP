@extends('layouts.master')

@section('title', 'Production | ')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Production Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Production</a></li>
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
        <th rowspan="2">Order ID</th>
        <th rowspan="2">Company Name</th>
        <th rowspan="2">Product ID</th>
        <th rowspan="2">Product Name</th>
        <th colspan="3">Process</th>
        <th rowspan="2">Action</th>
    </tr>
    <tr style="vertical-align: middle; text-align:center">
        <th>Cutting</th>
        <th>Bending</th>
        <th>Pasting</th>
    </tr>
</thead>

<tbody>
                                @foreach($designs as $design)
                                    <tr>
                                        <td style="text-align: center;">{{ $design->order_id }}</td>
                                        <td style="text-align: center;">{{ $design->company_name }}</td>
                                        <td style="text-align: center;">{{ $design->product->id }}</td>
                                        <td style="text-align: center;">{{ $design->product->name }}</td>
                                        <td style="text-align: center;"><span style="color: {{ in_array('Cutting', explode(',', $design->process)) ? 'green' : 'red' }}">{{ in_array('Cutting', explode(',', $design->process)) ? '✔' : '✘' }}</span></td>
                                        <td style="text-align: center;"><span style="color: {{ in_array('Bending', explode(',', $design->process)) ? 'green' : 'red' }}">{{ in_array('Bending', explode(',', $design->process)) ? '✔' : '✘' }}</span></td>
                                        <td style="text-align: center;"><span style="color: {{ in_array('Pasting', explode(',', $design->process)) ? 'green' : 'red' }}">{{ in_array('Pasting', explode(',', $design->process)) ? '✔' : '✘' }}</span></td>
                                        <td>
    <a class="btn btn-primary" href="{{ route('production.create', ['order_id' => $design->order_id]) }}"><i class="fa fa-plus"></i></a>
    <a class="btn btn-info" href="{{ route('production.edit', ['order_id' => $design->order_id]) }}"><i class="fa fa-circle"></i></a>
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
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('refresh'))
                location.reload();
            @endif
        });
    </script>

    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>


    
@endpush