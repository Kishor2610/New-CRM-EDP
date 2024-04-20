

@extends('layouts.master')

@section('titel', 'Category | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Customer Query Data</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item active"><a href="#">View Query</a></li>
            </ul>
        </div>
       

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Customer name</th>
                                <th>Email </th>
                                <th>Subject </th>
                                <th>Query</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $queries_view as $queries_view)
                            <tr>
                                <td>{{$queries_view->user_name}}</td>
                                <td>{{ $queries_view->email }} </td>
                                <td>{{ $queries_view->query_subject }}</td>
                                <td>{{$queries_view->query_message}}</td>
                                <td>  
                                  
                                    @if($queries_view->status!='2')
                                      <button class="btn btn-danger" type="button" onclick="openReplyModal('{{ $queries_view->id }}')">
                                          Send Reply_ <i class="fa fa-paper-plane"></i>
                                        </button>
                                     @endif
                                    
                                    @if($queries_view->status=='3')
                                      <button class="btn btn-success" type="button">Mail Sended <i class="fa fa-paper"></i>
                                      </button> 
                                     
                                    @endif
                                </td>
                                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


         <!-- Add this modal at the end of your Blade template -->
            <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to Query</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="replyForm" action="{{ route('send_reply') }}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="solution">Solution:</label>
                        <textarea class="form-control" id="solution" name="solution" rows="4" required></textarea>
                      </div>
                      <input type="hidden" id="customerId" name="id" value="">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="replyForm" class="btn btn-primary">Send Mail</button>
                  </div>
                </div>
              </div>
            </div>

    </main>

@endsection



<script>
    function openReplyModal(customerId) {
      $('#customerId').val(customerId);
      $('#replyModal').modal('show');
    }
  </script>