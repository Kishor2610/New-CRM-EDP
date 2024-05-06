@extends('layouts.master')

@section('title', 'Enquiries | ')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Enquiry Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Enquiry</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row mt-2">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="{{route('enquiry.create')}}"><i class="fa fa-payment"></i>Create Enquiry</a>
            </div>
        </div>

        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Change Status and Add Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('enquiry.change_status') }}">
                            @csrf
                            <input type="hidden" name="enquiry_id" id="enquiry_id">
                            <div class="form-group">
                                <label for="status">New Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">New</option>
                                    <option value="2">In Progress</option>
                                    <option value="3">Send to Quotation</option>
                                    <option value="4">Cancel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Company</th>
                                    {{-- <th>Mobile No.</th> --}}
                                    <th>Email</th>
                                    <th>Enquiry</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($enquiries as $enquiry)
                                    <tr>
                                        <td>{{ $enquiry->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $enquiry->company_name }}</td>
                                        {{-- <td>{{ $enquiry->mobile }}</td> --}}
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->enquiry_source }}</td>
                                        <td>{{ $enquiry->item }}</td>
                                        <td>{{ $enquiry->qty }}</td>
                                        <td>{{ $enquiry->comment }}</td>

                                        <td>
                                            @if($enquiry->status == '1')     New                           
                                            @elseif($enquiry->status == '2') In Progress
                                            @elseif($enquiry->status == '3') Send to Quotation
                                            @elseif($enquiry->status == '4') Cancel
                                            @else New
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-primary" href="{{ route('enquiry.edit', $enquiry->id) }}"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-info" onclick="showStatusModal('{{ $enquiry->company_name }}', '{{ $enquiry->mobile }}', '{{ $enquiry->email }}', '{{ $enquiry->id }}')"><i class="fa fa-circle"></i></button>
                                            <button class="btn btn-danger waves-effect" type="button" onclick="deleteEnquiry(event, {{$enquiry->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete-form-{{ $enquiry->id }}" action="{{ route('enquiry.destroy', $enquiry->id) }}" method="POST" style="display: none;">
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
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteEnquiry(event, id) {
            event.stopPropagation();
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
                    document.getElementById('delete-form-' + id).submit();
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            });
        }
    </script>

    <script type="text/javascript">
        function showStatusModal(companyName, mobile, email, id) {
            // Set values in the modal
            document.getElementById('enquiry_id').value = id;
            // Show the modal
            $('#statusModal').modal('show');
        }
    </script>

@endpush