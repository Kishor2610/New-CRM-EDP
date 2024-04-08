@extends('layouts.master')

@section('title', 'Customer | ')
@section('content')
@include('partials.header')
@include('partials.sidebar')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Create Customer</h1>
      <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Customer</a></li>
    </ul>
  </div>

  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif

  <!-- <div class="">
    <a class="btn btn-primary" href="{{route('customer.index')}}"><i class="fa fa-edit"> Customer </a>
  </div> -->

  <div class="row mt-2 justify-content-center"> <!-- Centering the content -->
    <div class="col-md-10"> <!-- Adjusted column width -->
      <div class="tile" style="width: 95%;"> <!-- Increased width of the white box -->
        <h3 class="tile-title">Customer</h3>
        <div class="tile-body">
          <form method="POST" action="{{route('customer.store_data')}}">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="control-label">Customer Name</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Customer Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label class="control-label">Customer Mobile</label>
                <input name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Customer Address</label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height: 40px;"></textarea> <!-- Reduced height -->
              @error('address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label">Customer Details</label>
              <textarea name="details" class="form-control @error('details') is-invalid @enderror" style="height: 40px;"></textarea> <!-- Reduced height -->
              @error('details')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label">Previous Credit Balance</label>
              <input name="previous_balance" class="form-control @error('previous_balance') is-invalid @enderror" type="text" placeholder="Enter Balance">
              @error('previous_balance')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection