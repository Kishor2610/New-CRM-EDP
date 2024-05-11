@extends('layouts.master')

@section('title', 'Order | ')
@section('content')
@include('partials.header')
@include('partials.sidebar')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Create Order</h1>
      <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a href="/"><i class="fa fa-home fa-lg"></i></a>
    </li>
      <li class="breadcrumb-item"><a href="{{route('order.index')}}">Order</a></li>
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
        <h3 class="tile-title">Order</h3>
        <div class="tile-body">
          <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <div class="form-row">

              <div class="form-group col-md-6">
                <label class="control-label">Company Name *</label>
                <input name="company_name" value="{{$companyName}}" class="form-control @error('company_name') is-invalid @enderror" type="text" placeholder="Enter Company Name">
                @error('company_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <input type="hidden" name="quotation_id" value="{{ $quotationId }}">
              <input type="hidden" name="total" value="{{ $total }}">

             
              <div class="form-group col-md-6">
                <label class="control-label">Mobile Number *</label>
                <input name="mobile" value="{{$companyMobile}}" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              
            <div class="form-group col-md-6">
              <label class="control-label">Email *</label>
              <input id="email" value="{{$companyEmail}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            </div>

            <div class="form-row">

              {{-- <div class="form-group col-md-6">
                  <label class="control-label">Item *</label>
                  <select name="item[]" id="item" class="form-control @error('item') is-invalid @enderror" multiple style="height: 40px;">
                    @foreach($products as $productId => $productName)
                        <option value="{{ $productId }}">{{ $productName }}</option>
                    @endforeach
                </select>
                @error('item')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div> --}}

              <div class="form-group col-md-6">
                <label class="control-label">Item *</label>
                <select name="item[]" id="item" class="form-control @error('item') is-invalid @enderror" multiple style="height: 40px;">
                    @foreach($products as $productId => $productName)
                        <option value="{{ $productId }}" selected>{{ $productName }}</option>
                    @endforeach
                </select>
                @error('item')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

              <div class="form-group col-md-6">
                  <label class="control-label">PO Number</label>
                  <input name="po_number" class="form-control @error('po_number') is-invalid @enderror" type="text" placeholder="Enter PO Number">
                  @error('po_number')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Expected Delivery Date *</label>
                <input name="expected_delivery" class="form-control @error('expected_delivery') is-invalid @enderror" type="date" placeholder="Select Expected Delivery Date" required>
                @error('expected_delivery')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

          </div>         

         

            <div class="form-group">
              <label class="control-label">Comment</label>
              <textarea name="comment" class="form-control @error('Comment') is-invalid @enderror" style="height: 40px;"></textarea>
              @error('Comment')
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
