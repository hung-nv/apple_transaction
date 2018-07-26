@extends('backend.layouts.app')

@section('title')
    Create user
@endsection

@section('breadcrumbs')
    <a href="{{ route('user.index') }}">Users</a>
@endsection

@section('content')
    <h3 class="page-title"> Managed User
        <small>Create</small>
    </h3>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Create User</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                           data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('user.store') }}" class="form-horizontal" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.user._form')

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection