

@extends('layouts.master')

@section('titel', 'Customer | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Product Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Product </a></li>
            </ul>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Product Name </th>
                                <th>Model </th>
                                {{-- <th>Supplier Price</th> --}}
                                {{-- <th>Supplier Name</th> --}}
                                <th>Image</th>
                                <th>Sales Price</th>
                                <th>Product Qty</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($products as $product)
                                 <tr>
                                     <td>{{$product->name}}</td>
                                     <td>{{$product->model}}</td>

                                     {{-- <td>{{$price}}</td> --}}
                                     {{-- <td>{{$product->supplier->name}}</td> --}}

                                     {{-- <td>
                                        @foreach($suppliers as $supplier)
                                            @if($supplier->id === $product->supplier_id)
                                                {{$supplier->name}}
                                            @endif
                                        @endforeach
                                    </td> --}}

                                     <td><img width="60 px" src="{{ asset('/images/product/'.$product->image) }}"></td>
                                     <td>{{$product->sales_price}}</td>
                                     <td>{{$product->product_qty}}</td>
                                     <td>
                                         <a class="btn btn-primary" href="{{route('product.edit', $product->id)}}"><i class="fa fa-edit" ></i></a>
                                         <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $product->id }})">
                                             <i class="fa fa-trash-o"></i>
                                         </button>
                                         <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy',$product->id) }}" method="POST" style="display: none;">
                                             @csrf
                                             @method('DELETE')
                                         </form>
                                     </td>
                                 </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
