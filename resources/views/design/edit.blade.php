@extends('layouts.master')

@section('title', 'Edit Design Data')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Edit Design Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Design</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ul>
        </div>

        <div class="row mt-2 justify-content-center">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                    <form method="post" action="{{ route('design.update', $order->order_id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Row 1 -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" value="{{ $order->company_name }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="po_number">PO Number</label>
                                    <input type="text" class="form-control" id="po_number" value="{{ $order->po_number }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="order_id">Order ID</label>
                                    <input type="text" class="form-control" id="order_id" value="{{ $order->order_id }}" disabled>
                                </div>
                            </div>

                            <!-- Row 2 -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="item_code">Item Code</label>
                                    <input type="text" class="form-control" id="item_code" name="item_code" value="{{ $design->item_code }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="qty">Qty</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{ $design->qty }}">
                                </div>
                            </div>

                            <!-- Row 3 -->
                            <div class="form-row">
                            <div class="form-group col-md-4">
        <label>Process</label><br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="process_cutting" name="process[]" value="Cutting" {{ in_array('Cutting', explode(',', $design->process)) ? 'checked' : '' }}>
            <label class="form-check-label" for="process_cutting">Cutting</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="process_bending" name="process[]" value="Bending" {{ in_array('Bending', explode(',', $design->process)) ? 'checked' : '' }}>
            <label class="form-check-label" for="process_bending">Bending</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="process_pasting" name="process[]" value="Pasting" {{ in_array('Pasting', explode(',', $design->process)) ? 'checked' : '' }}>
            <label class="form-check-label" for="process_pasting">Pasting</label>
        </div>
    </div>
                                <div class="form-group col-md-4">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <img width="40 px" src="{{ asset('/images/design/'.$design->image) }}" alt="Design Image">
                                </div>
                                <div class="form-group col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark">{{ $design->remark }}</textarea>
                                </div>
                            </div>
                            </div>

<div class="form-row justify-content-center">
    <div class="form-group col-md-6 text-center">
        <button type="submit" class="btn btn-primary">Update Design</button>
    </div>
</div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
