

@extends('layouts.master')

@section('titel', 'Sales | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> View Sales</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">View Sales</a></li>
            </ul>
        </div>
       

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Invoice ID </th>
                                <th>Date </th>
                                <th>Customer Name </th>
                                <th>Product Name </th>
                                <th>Product Image </th>
                                <th> Qty </th>
                                <th> Discount  </th>
                                <th> Price  </th>
                                {{-- <th>Total Amount  </th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($sales as $sales)
                                 <tr>
                                     <td>{{1000+$sales->id}}</td>
                                     <td>{{$sales->created_at->format('Y-m-d')}}</td>
                                     <td>{{ $sales->invoice->customer->name }}</td>
                                     <td>{{ $sales->product->name }}</td>
                                     <td><img width="60 px" src="{{ asset('images/product/'.$sales->product->image) }}"></td>
                                     <td>{{$sales->qty}}</td>
                                     <td>{{$sales->dis}}</td>
                                     <td>{{$sales->price * $sales->qty}}</td>
                                     {{-- <td>{{$sales->amount}}</td> --}}
                                     {{-- <td>{{$invoicetotal}}</td> --}}
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
