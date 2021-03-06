@extends('back.index') 

@section('title')
	{{ 'List User' }}
@endsection 

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">List Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2 ">
            <div class="col-sm-12  row justify-content-center align-items-center">

                @include('back.users.create')

            </div><!-- /.col -->
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
						<table id="example1" class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Validate</th>
									<th>Confirm</th>
									<th>Date</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>
							</thead>
							@if(sizeof($users) > 0)
            					@foreach($users as $user)
            					<tr>
            						<td>{{ $user->id}}</td>
            						<td>{{ $user->name}}</td>
									<td>{{ $user->email}}</td>
									<td>{{ $user->role === 1 ? 'Admin' : 'User' }}</td>
									<td> <input type="checkbox" id="active" name="status" value="{{ $user->id }}" {{ $user->valid ? 'checked' : ''}}></td>
									<td> <input type="checkbox" id="active" name="status" value="{{ $user->id }}" {{ $user->confirmed ? 'checked' : ''}} disabled></td>
									<td>{{ $user->created_at->formatLocalized('%c') }}</td>
									<td>
										<div class="m-sm-auto ">
												<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{ $user->id}}"><span class="fa fa-edit"></span>	
												</button>
												
										</div>
									</td>            
									<td>
										<div class="m-sm-auto">
											<button type="button" title="Delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$user->id}}"> <span class="fa fa-trash"></span>	
											</button>
											
										</div>
									</td>
								</tr>
            					@endforeach
            				@endif
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
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

@endsection
