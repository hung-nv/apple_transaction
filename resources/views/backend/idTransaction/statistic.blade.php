@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('title', 'Statistic')

@section('pageId', 'statistic')

@section('breadcrumbs')
    <a href="{{ route('idTransaction.statistic') }}">Statistic</a>
@endsection

@section('content')
    <h3 class="page-title"> Statistic
        <small>All</small>
    </h3>

    <div class="row">
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
                        @include('backend.idTransaction._searchStatistic')

                        @include('backend.idTransaction._statistic')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/admin/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
@endpush