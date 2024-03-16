@extends('layouts.master')

@section('title', 'Home | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Edit Raw Material </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Raw Material</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="clearix"></div>
            <div class="col-md-10">
                <div class="tile">
                    <h3 class="tile-title">Raw Material</h3>
                    <div class="tile-body">
                        <form class="row" method="POST" action="{{route('raw_material.update', $raw_material->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-8">
                                <label class="control-label">Raw Material Name</label>
                                <input name="material_name" value="{{ $raw_material->material_name }}" class="form-control @error('material_name') is-invalid @enderror" type="text" placeholder="Enter your name">
                                @error('material_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



