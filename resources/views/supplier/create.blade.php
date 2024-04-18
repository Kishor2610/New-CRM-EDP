@extends('layouts.master')

@section('title', 'Supplier | ')
@section('content')
@include('partials.header')
@include('partials.sidebar')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Create Supplier</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a href="/"><i class="fa fa-home fa-lg"></i></a>
    </li>
      <li class="breadcrumb-item"><a href="#">Supplier</a></li>
    </ul>
  </div>

  @if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif

  <div class="row mt-2 justify-content-center">
    <div class="col-md-10">
      <div class="tile" style="width: 95%;">
        <h3 class="tile-title">Supplier</h3>
        <div class="tile-body">
          <form method="POST" action="{{route('supplier.store')}}">
            @csrf
            <div class="form-group row">
              <div class="col-md-6">
                <label class="control-label">Supplier Name *</label>
                <input name="name" value="XYZXYZ" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Supplier Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="control-label">Supplier Mobile *</label>
                <input name="mobile" value="8208378029" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Supplier Mobile No.">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Supplier Address *</label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height: 40px;">XYZXYZ</textarea>
              @error('address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          {{-- <div class="form-group">
            <label class="control-label">Supplier Raw Material *</label>
            <select id="details" name="details[]" class="form-control select2" multiple="multiple>
                <option>Select Supplier</option>
                  @foreach($rawMaterials as $rawMaterial)
                      <option value="{{ $rawMaterial->material_name }}">{{ $rawMaterial->material_name }}</option>
                  @endforeach
            </select>
            @error('details')
            <span class=" invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div> --}}

          <div class="form-group">
            <label class="control-label">Supplier Raw Materials *</label>
            <select id="details" name="details[]" class="form-control select2" multiple="multiple">
                @foreach($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->material_name }}</option>
                @endforeach
            </select>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

          {{-- <select id="leave_status" name="details[]" title="Leave Status" 
            class="form-control select2" multiple="multiple">       
            <option value="1">Alabama</option>
            <option value="2">Alaska</option>
            <option value="3">California</option>
            <option value="4">Delaware</option>
            <option value="5">Tennessee</option>
            <option value="6">Texas</option>
            <option value="7">Washington</option>
          </select> --}}






            {{-- <div class="form-group">
              <label class="control-label">Previous Credit Balance </label>
              <input name="previous_balance" value="0" class="form-control @error('previous_balance') is-invalid @enderror" type="text" placeholder="Enter Balance">
              @error('previous_balance')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div> --}}

            <div class="form-group text-center"> <!-- Centering the button -->
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection