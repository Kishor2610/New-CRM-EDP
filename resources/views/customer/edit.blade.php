@extends('layouts.master')

@section('title', 'Customer | ')

@section('content')
@include('partials.header')
@include('partials.sidebar')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Edit Customer Information</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a href="/"><i class="fa fa-home fa-lg"></i></a>
    </li>
      <li class="breadcrumb-item"><a href="#">Customer</a></li>
    </ul>
  </div>

  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif

  <div class="row mt-2 justify-content-center">
    <div class="col-md-10">
      <div class="tile">
        <h3 class="tile-title">Customer</h3>
        <div class="tile-body">
          <form method="POST" action="{{ route('customer.update', $customer->id) }}">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="control-label">Customer Name</label>
                <input value="{{ $customer->name }}" name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Customer Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label class="control-label">Customer Mobile</label>
                <input value="{{ $customer->mobile }}" name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label">Customer Email</label>
              <input id="email" value="{{ $customer->email }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email Number" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

            <div class="form-group">
              <label class="control-label">Customer Address</label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height: 40px;">{{ $customer->address }}</textarea>
              @error('address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label">Customer Details</label>
              <textarea name="details" class="form-control @error('details') is-invalid @enderror" style="height: 40px;">{{ $customer->details }}</textarea>
              @error('details')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label">Customer Credit Balance</label>
              <input value="{{ $customer->previous_balance }}" name="previous_balance" class="form-control @error('previous_balance') is-invalid @enderror" type="text" placeholder="Enter Balance">
              @error('previous_balance')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection