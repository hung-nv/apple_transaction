@extends('backend.layouts.app')

@section('title')
    Administrator
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
                        <span>Dashboard</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Administrator Dashboad
            </h3>
        </div>
    </div>
@endsection