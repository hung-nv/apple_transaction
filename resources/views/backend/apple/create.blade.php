@extends('backend.layouts.app')

@section('title')
    Manage user
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('apple.index') }}">Apple Id</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Insert</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <h3 class="page-title"> Apple ID
                <small>Insert</small>
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-green-haze">
                                <i class="icon-settings font-green-haze"></i>
                                <span class="caption-subject bold uppercase"> Insert Apple ID</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                                   data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">

                            @include('backend.blocks.message')

                            <form action="{{ route('apple.store') }}" class="form-horizontal" role="form"
                                  method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                @include('backend.blocks.errors')

                                @include('backend.apple._form')

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-8">
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        </div>
    </div>
@endsection