@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title', 'Manage ID Purchase')

@section('pageId', 'idPurchase')

@section('breadcrumbs')
    <a href="{{ route('idPurchase.index') }}">ID Purchase</a>
@endsection

@section('content')
    <h3 class="page-title"> Manage ID Purchase
        <small>All</small>
    </h3>

    @include('backend.blocks.message')

    <div class="row" id="idApple">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Data</span>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                        @include('backend.idPurchase._searchBox')

                        @include('backend.idPurchase._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection