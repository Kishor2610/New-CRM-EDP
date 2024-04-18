@extends('layouts.master')

@section('title', 'Supplier | ')

@section('content')
@include('partials.header')
@include('partials.sidebar')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Edit Supplier Information</h1>
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
      <div class="tile">
        <h3 class="tile-title">Supplier</h3>
        <div class="tile-body">
          <form method="POST" action="{{ route('supplier.update', $supplier->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <div class="col-md-6">
                <label class="control-label">Supplier Name</label>
                <input value="{{ $supplier->name }}" name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Supplier Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="control-label">Supplier Mobile</label>
                <input value="{{ $supplier->mobile }}" name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile Number">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Supplier Address</label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height: 40px;">{{ $supplier->address }}</textarea>
              @error('address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          
            {{-- <div class="form-group">
              <label class="control-label">Supplier Raw Material</label>
              <textarea name="details" class="form-control @error('details') is-invalid @enderror" style="height: 40px;">{{ $supplier->details }}</textarea>
              @error('details')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div> --}}

            <div class="form-group">
              <label class="control-label">Supplier Raw Material</label>
              <select name="details" class="form-control">
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
            </div>


            <div class="form-group">
              <label class="control-label">Previous Credit Balance</label>
              <input value="{{ $supplier->previous_balance }}" name="previous_balance" class="form-control @error('previous_balance') is-invalid @enderror" type="text" placeholder="Enter Previous Balance">
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