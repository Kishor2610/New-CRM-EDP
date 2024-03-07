

@extends('layouts.master')

@section('titel', 'Category | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Category List</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item active"><a href="#">Category List</a></li>
            </ul>
        </div>
        <div class="">
            {{-- <a class="btn btn-primary" href="{{route('category.create')}}"><i class="fa fa-plus"> Add Category</i></a> --}}
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach( $categories as $category)
                        
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Category Status">
                                        @if($category->status == '1')
                                        <button type="button" class="btn btn-success toggle-class" data-id="{{ $category->id }}" data-status="{{ $category->status ? 'active' : 'inactive' }}">
                                            Active
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-danger toggle-class" data-id="{{ $category->id }}" data-status="{{ $category->status ? 'active' : 'inactive' }}">
                                            Inactive
                                        </button>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <a class="btn btn-primary" href="{{route('category.edit', $category->id)}}"><i class="fa fa-edit" ></i></a>
                                    <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $category->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy',$category->id) }}" method="POST" style="display: none;">
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
                text: " ",
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


<script>
    $(function() {
        $('.toggle-class').click(function() {
            var id = $(this).data('id'); 
            var status = $(this).data('status') === 'active' ? 0 : 1;

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'id': id},
                success: function(data){
                    if (data.success) {
                        var button = $('.toggle-class[data-id="' + id + '"]');
                        if (status === 1) {
                            button.data('status', 'active').removeClass('btn-danger').addClass('btn-success').text('Active');
                        } else {
                            button.data('status', 'inactive').removeClass('btn-success').addClass('btn-danger').text('Inactive');
                        }
                        location.reload();
                    }else {
                        console.error('Status change failed:', data.error);
                    }
                }
            });
        });
    });
</script>


@endpush


