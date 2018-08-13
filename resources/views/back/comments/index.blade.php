@extends('back.index')

@section('title')
    {{ 'List Comments' }}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">List Comments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Comments</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2 ">
            <div class="col-sm-12">
                @if(count($errors) > 0)
                    <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #EE7C60 !important; font-size: 14px; margin-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach()
                        </strong>
                    </div>
                @endif
                @if(session('message'))
                    <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #7DF5B4 !important; font-size: 14px; margin-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('message')}}</strong>
                    </div>
                @endif
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="list-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
								@foreach($comments as $comment)
								    <tr class="pannel" data-boardid="{{ $comment->id }}">
								        <td>{{ $comment->user->name }}</td>
								        <td><a href="#">{{ $comment->user->email }}</a></td>
								        <td>{{ $comment->post->title }}</td>
								        <td><strong><p data-toggle="tooltip" title="{{$comment->content_cmt}}">{{ $comment->content_cmt}}</p></strong></td>
								        <td>{{ $comment->created_at->formatLocalized('%c') }}</td>
								        <td>
								            <div class="m-sm-auto">
								                <button type="button" title="Delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$comment->id}}"> <span class="fa fa-trash"></span>  
								                </button>
								                @include('back.comments.delete')
								            </div>
								        </td>
								    </tr>
								@endforeach
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('js')

<!-- page script -->
<script src="{{asset('js/backend/back.js')}}"></script>
<script>
    $(function () {
        $("#list-table").DataTable();
    });
</script>

@endsection
