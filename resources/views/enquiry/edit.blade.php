@extends('layouts.master')

@section('title', 'Edit Enquiry | ')
@section('content')
@include('partials.header')
@include('partials.sidebar')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Edit Enquiry</h1>
      <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a href="/"><i class="fa fa-home fa-lg"></i></a>
      </li>
      <li class="breadcrumb-item"><a href="{{route('enquiry.index')}}">Enquiry</a></li>
    </ul>
  </div>

  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif

  <div class="row mt-2 justify-content-center"> <!-- Centering the content -->
    <div class="col-md-10"> <!-- Adjusted column width -->
      <div class="tile" style="width: 95%;"> <!-- Increased width of the white box -->
        <h3 class="tile-title">Enquiry</h3>
        <div class="tile-body">
          <form method="POST" action="{{ route('enquiry.update', $enquiry->id) }}"> <!-- Use route for updating the enquiry -->
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="control-label">Company Name *</label>
                <input name="company_name" value="{{ $enquiry->company_name }}" class="form-control @error('company_name') is-invalid @enderror" type="text" placeholder="Enter Company Name">
                @error('company_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Mobile Number *</label>
                <input name="mobile" value="{{ $enquiry->mobile }}" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
              <div class="form-group col-md-6">
                  <label class="control-label">Email *</label>
                  <input id="email" value="{{ $enquiry->email }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="control-label">Item *</label>
                <input name="item" value="{{ $enquiry->item }}" class="form-control @error('item') is-invalid @enderror" type="text" placeholder="Enter Item">
                @error('item')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Qty *</label>
                <input name="qty" value="{{ $enquiry->qty }}" class="form-control @error('qty') is-invalid @enderror" type="text" placeholder="Enter Qty">
                @error('qty')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label class="control-label">Source of Enquiry *</label>
              <input name="enquiry_source" value="{{ $enquiry->enquiry_source }}" class="form-control @error('enquiry_source') is-invalid @enderror" type="text" placeholder="Enter Source of Enquiry">
              @error('enquiry_source')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="control-label">Description *</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" style="height: 40px;">{{ $enquiry->description }}</textarea>
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="control-label">Customer Specification *</label>
              <textarea name="customer_specification" class="form-control @error('customer_specification') is-invalid @enderror" style="height: 40px;">{{ $enquiry->customer_specification }}</textarea>
              @error('customer_specification')
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
