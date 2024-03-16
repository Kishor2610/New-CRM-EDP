@extends('layouts.master')

@section('title', 'Raw Material | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus"></i> Create Material </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('raw_material.create') }}">Material</a></li>

            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row mt-2 justify-content-center">

            <div class="clearix"></div>
            <div class="col-md-10">
                <div class="tile">
                    <h3 class="tile-title">Raw Material</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('raw_material.store')}}">
                            @csrf
                            <div class="form-group col-md-6">
                                <label class="control-label">Material Name</label>
                                <input name="material_name" class="form-control @error('material_name') is-invalid @enderror" type="text" placeholder="Enter Material Name">
                                @error('material_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4 text-center">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



