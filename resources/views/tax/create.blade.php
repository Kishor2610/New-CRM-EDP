@extends('layouts.master')

@section('title', 'Tax | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Tax</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Tax</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
        </div>
        <div class="row mt-2 justify-content-center">

            {{-- <div class="clearix"></div> --}}
            <div class="col-md-10">
                {{-- <div class="tile"> --}}
                <div class="tile" style="width: 95%;">
                    <h3 class="tile-title">Tax</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('tax.store')}}">

                            @csrf
                            <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label">Tax Name</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Tax Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>


                            <div class="col-md-6">
                                <label class="control-label">Tax Value</label>
                                <input name="tax_value" class="form-control @error('tax_value') is-invalid @enderror" type="text" placeholder="Enter Tax Value">
                                @error('tax_value')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group col-md-12 text-center">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



