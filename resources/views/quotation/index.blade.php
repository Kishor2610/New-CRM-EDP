

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

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif


          <!-- Status Modal -->
    <div class="modal fade" id="quotationStatusModal" tabindex="-1" role="dialog" aria-labelledby="quotationStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quotationStatusModalLabel">Change Status and Add Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form id="changeQuotationStatusForm"> --}}
                    <form method="POST" action="{{ route('quotation.change_quotation_status') }}">
                        @csrf
                        <input type="hidden" name="quotation_id" id="quotation_id">
                        <div class="form-group">
                            <label for="status">New Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">New</option>
                                <option value="2">In Progress</option>
                                <option value="3">Order confirmed</option>
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
    <!-- End Status Modal -->

       

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Quotation ID </th>
                                <th>Company Name </th>
                                <th>Date </th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                          
                          
                        <tbody> 

                             @foreach($quotations as $quotation)
                                 <tr>
                                     <td>{{1000+$quotation->id}}</td>
                                     <td>{{$quotation->customer->name}}</td>
                                     <td>{{$quotation->created_at->format('Y-m-d')}}</td>
                                     <td>{{$quotation->comment}}</td>
                                     <td>
                                        @if($quotation->status == '1') New
                                        @elseif($quotation->status == '2') In Progress
                                        @elseif($quotation->status == '3') Quotation Accepted
                                        @elseif($quotation->status == '4') Cancel
                                        @else New
                                        @endif
                                     </td>
                                                                        
                                     <td>

                                        <a class="btn btn-primary" href="{{route('quotation.create')}}"><i class="fa fa-plus" ></i></a>

                                        <a class="btn btn-primary" href="{{route('quotation.show', $quotation->id)}}"><i class="fa fa-bandcamp" ></i></a>

                                        <a class="btn btn-primary" href="{{route('quotation.edit', $quotation->id)}}"><i class="fa fa-edit" ></i></a>

                                        <button class="btn btn-info" onclick="showQuotationStatusModal('{{ $quotation->id }}')"><i class="fa fa-circle"></i></button>


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



<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    function showQuotationStatusModal(quotationId) {
        // Set values in the modal
        document.getElementById('quotation_id').value = quotationId;
        // Show the modal
        $('#quotationStatusModal').modal('show');
    }

    $(document).ready(function() {
        $('#changeQuotationStatusForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route('quotation.change_quotation_status') }}',
                data: formData,
                 success: function(response) {
                        // Handle success response
                        alert('Quotation status and comment updated successfully.');
                        $('#quotationStatusModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert('Error updating quotation status and comment.');
                    }
            });
        });
    });
</script>


@endpush
