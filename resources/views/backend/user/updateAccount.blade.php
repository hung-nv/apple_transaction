@extends('backend.layouts.app')

@section('title')
    Account Information
@endsection

@section('style')
    <link href="{{ asset('/admin/assets/css/profile.min.css') }}" rel="stylesheet" type="text/css">
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
                        <a href="{{ route('user.index') }}">Users</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Account Information</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> User Profile | Account
                <small>user account page</small>
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-sidebar">
                        <div class="portlet light profile-sidebar-portlet ">
                            <div class="profile-userpic">
                                <img src="{{ asset('/admin/assets/img/photo3.jpg') }}" class="img-responsive" alt="">
                            </div>

                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{ Auth::user()->name }} </div>
                                <div class="profile-usertitle-job"> Developer </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        @include('backend.blocks.message')
                                        @include('backend.blocks.errors')

                                        <form role="form" action="{{ route('user.putUpdateAccount') }}"  method="post" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label">Your Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" class="form-control" name="old_password">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control" name="password" id="password">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                            <div class="margiv-top-10">
                                                <button type="submit" class="btn green">Save Changes</button>
                                                <button type="reset" class="btn default">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection