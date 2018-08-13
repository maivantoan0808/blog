@extends('front.index') 

@section('title')
    {{ 'Home' }}
@endsection 

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 700px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>BKFA Team</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="z-index: 0;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
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
                    <div>
                        <!-- /.card-header -->
                        <div class="container-fluid">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="row infinite-scroll">
                                        @include('front/partials/home-list')
                                        <div class="row">
                                            {{ $posts->links() }}
                                        </div>
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="list1">

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="list0">
                                    
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    @include('front.partials.home-right')
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
