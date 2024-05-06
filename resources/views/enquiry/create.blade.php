@extends('layouts.master')

@section('title', 'Enquiry | ')
@section('content')
@include('partials.header')
@include('partials.sidebar')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Create Enquiry</h1>
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
          <form method="POST" action="{{route('enquiry.store_data')}}">
            @csrf
            <div class="form-row">

              <div class="form-group col-md-6">
                <label class="control-label">Company Name *</label>
                <input name="company_name" class="form-control @error('company_name') is-invalid @enderror" type="text" placeholder="Enter Company Name">
                @error('company_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
             
              <div class="form-group col-md-6">
                <label class="control-label">Mobile Number *</label>
                <input name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              
            <div class="form-group col-md-6">
              <label class="control-label">Email *</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                  <select name="item" id="item" class="form-control @error('item') is-invalid @enderror">
                    <option value="">Select Item</option>
                    @foreach($products as $product)
                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                    @endforeach
                    <option value="other">Other</option>
                  </select>
                  
                  <input type="text" name="other_item" id="other_item" class="form-control mt-2" style="display: none;" placeholder="Enter Other Item">
        
                @error('item')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
          
              <div class="form-group col-md-6">
                  <label class="control-label">Qty *</label>
                  <input name="qty" class="form-control @error('qty') is-invalid @enderror" type="text" placeholder="Enter Qty">
                  @error('qty')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>


          <div class="form-group">
            <label class="control-label">Source of Enquiry *</label>
            <input name="enquiry_source" class="form-control @error('enquiry_source') is-invalid @enderror" type="text" placeholder="Enter Source of Enquiry">
            @error('enquiry_source')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          

            <div class="form-group">
              <label class="control-label">Description *</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" style="height: 40px;"></textarea>
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

           

            <div class="form-group">
              <label class="control-label">Customer Specification *</label>
              <textarea name="customer_specification" class="form-control @error('customer_specification') is-invalid @enderror" style="height: 40px;"></textarea>
              @error('customer_specification')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection



<script>
  document.addEventListener('DOMContentLoaded', function () {
      var itemSelect = document.getElementById('item');
      var otherItemInput = document.getElementById('other_item');

      if (itemSelect) {
          itemSelect.addEventListener('change', function () {
              if (this.value === 'other') {
                  otherItemInput.style.display = 'block';
                  otherItemInput.setAttribute('required', 'required');
              } else {
                  otherItemInput.style.display = 'none';
                  otherItemInput.removeAttribute('required');
              }
          });
      }
  });
</script>
