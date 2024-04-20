@extends('layouts.master')

@section('title', 'Customer | ')
<!-- @section('content') -->
@include('partials.customerheader')
@include('partials.customersidebar')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Create Query</h1>
      <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
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
        <h3 class="tile-title">Customer</h3>
        <div class="tile-body">
          <form id="queryForm" method="POST" action="{{ route('customer.submitquery') }}">
            @csrf
            <div class="form-group">
              <label class="control-label">Query Subject</label>
              <input name="query_subject" class="form-control @error('query_subject') is-invalid @enderror" type="text" placeholder="Enter Query Subject">
              @error('query_subject')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label class="control-label">Query</label>
              <textarea name="query_message"class="form-control @error('query') is-invalid @enderror" style="height: 100px;"></textarea>
              @error('query')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
