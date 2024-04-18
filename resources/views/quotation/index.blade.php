

@extends('layouts.master')

@section('titel', 'Customer | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> View Quotation</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">View Quotation</a></li>
            </ul>
        </div>
       

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Quotation ID </th>
                                <th>Customer Name </th>
                                <th>Date </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($quotations as $quotation)
                                 <tr>
                                     <td>{{1000+$quotation->id}}</td>
                                     <td>{{$quotation->customer->name}}</td>
                                     <td>{{$quotation->created_at->format('Y-m-d')}}</td>
                                     <td>
                                         <a class="btn btn-primary" href="{{route('quotation.show', $quotation->id)}}"><i class="fa fa-bandcamp" ></i></a>
                                         <a class="btn btn-primary" href="{{route('quotation.edit', $quotation->id)}}"><i class="fa fa-edit" ></i></a>

                                         <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $quotation->id }})">
                                             <i class="fa fa-trash-o"></i>
                                         </button>
                                         <form id="delete-form-{{ $quotation->id }}" action="{{ route('quotation.destroy',$quotation->id) }}" method="POST" style="display: none;">
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
