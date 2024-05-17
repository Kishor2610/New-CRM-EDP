@extends('layouts.master')

@section('title', 'Add Production | ')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus"></i> Add Production</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('production.index') }}">Production</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ul>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                    <form method="POST" action="{{ route('production.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Company Name -->
    <div class="row">
    <div class="col-md-4">

    <div class="form-group">
        <label for="company_name">Company Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $design->company_name }}" readonly>
    </div>
    </div>

    <!-- Order ID -->
    <div class="col-md-4">
    <div class="form-group">
        <label for="order_id">Order ID</label>
        <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $design->order_id }}" readonly>
    </div>
    </div>

    <!-- Item Code -->
    <div class="col-md-4">

    <div class="form-group">
        <label for="item_code">Item Code</label>
        <input type="text" class="form-control" id="item_code" name="item_code" value="{{ $design->product->id }}" readonly>
    </div>
    </div>
    </div>

    <!-- Item Name -->
    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $design->product->name }}" readonly>
    </div>
    </div>


    <!-- Process -->
    <div class="col-md-6">
    <div class="form-group">
        <label for="process">Process</label>
        <div class="border p-1">
            @foreach($processes as $process)
                <div class="d-inline-block m-1">{{ $process }}</div>
            @endforeach
        </div>
    </div>
    </div>


    <!-- Hidden input fields for processes -->
    @foreach($processes as $process)
        <input type="hidden" name="process[]" value="{{ $process }}">
    @endforeach

    <!-- Submit Button -->
    <div class="form-group col-md-12 text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Production</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
