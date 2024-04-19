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
                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Supplier Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="control-label">Supplier Mobile *</label>
                <input name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Supplier Mobile No.">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Supplier Address *</label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height: 40px;"></textarea>
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
            <div class="col-md-3">
            <select id="details" name="details[]" class="form-control select2" style="height: 60px" multiple="multiple">
                @foreach($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->material_name }}</option>
                @endforeach
            </div>
            </select>
            @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div> 

  
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



@push('js')

<script type="text/javascript">
  $(document).ready(function() {
      $('select').selectpicker();
  });
</script>

@endpush