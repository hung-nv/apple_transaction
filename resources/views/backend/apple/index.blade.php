@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title', 'Manage ID Apple')

@section('pageId', 'idApple')

@section('breadcrumbs')
    <a href="{{ route('apple.index') }}">Apples</a>
@endsection

@section('content')
    <h3 class="page-title"> Manage ID Apple
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
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a class="btn sbold green" id="create-id-apple" v-on:click="createIdApple">
                                        Insert
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                        @include('backend.apple._searchBox')

                        @include('backend.apple._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection