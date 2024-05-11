@extends('layouts.master')

@section('title', 'Order | ')

@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Order Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Order</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        {{-- <div class="row mt-2">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="{{route('order.create')}}"><i class="fa fa-payment"></i>Create Order</a>
            </div>
        </div> --}}

        <div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Change Status and Add Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="changeOrderStatusForm" method="POST" action="{{ route('order.changeOrderStatus') }}">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id">
                            <div class="form-group">
                                <label for="status">New Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="2">In Progress</option>
                                    <option value="3">Order Confirmed</option>
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
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product ID</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Expected Delivery</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($organizedData as $quotationId => $data)
                                    
                                    @php
                                            $uniqueCustomerNames = array_unique($customerNamesByQuotationId[$quotationId]);
                                    @endphp
                                    
                                    @foreach ($data['products'] as $index => $product)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align:center">{{ $quotationId }}</td>
                                            @endif
    
                                            <td rowspan="">
                                                @foreach ($uniqueCustomerNames as $customerName)
                                                    {{ $customerName }}
                                                    @if (!$loop->last)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                        
                                            <td>{{ App\Product::find($product['product_id'])->name }}</td>
                                            <td>{{ $product['qty'] }}</td>


                                            <td> {{ $product['amount'] }}</td>

                                            
                                            @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle; text-align: center"> 14/2/2024</td>
                                            @endif
                                            
                                            @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle;">New</td>
                                            @endif

                                            @if ($index === 0)
                                            <td rowspan="{{ count($data['products']) }}" style="vertical-align: middle;">

                                                <a class="btn btn-primary" href="{{ route('order.create', ['quotation_id' => $quotationId]) }}">
                                                    <i class="fa fa-payment"></i> Place Order
                                                </a>
                                                <button class="btn btn-info" onclick="showStatusModal({{ $quotationId }})">
                                                    <i class="fa fa-circle"></i>Change Status
                                                </button>
                                             </td>
                                            @endif

                                        </tr>
                                    @endforeach 
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
      
      function showStatusModal(orderId) {
                // Set the order ID in the form
                document.getElementById('order_id').value = orderId;
                // Show the modal
                $('#statusModal').modal('show');
            }
    </script>


// JavaScript/jQuery code to handle form submission via AJAX

<script>
    function showOrderStatusModal(orderId) {
        // Set values in the modal
        document.getElementById('order_id').value = orderId;
        // Show the modal
        $('#orderStatusModal').modal('show');
    }

    $(document).ready(function() {
        $('#changeOrderStatusForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route('order.changeOrderStatus') }}',
                data: formData,
                success: function(response) {
                    // Handle success response
                    alert('Order status updated successfully.');
                    $('#orderStatusModal').modal('hide');
                    // You can also refresh the page or update the status column in the table dynamically
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('Error updating order status.');
                }
            });
        });
    });
</script>


@endpush