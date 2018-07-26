@extends('backend.layouts.app')

@section('title')
    Insert Serials
@endsection

@section('breadcrumbs')
    <a href="{{ route('serial.index') }}">Serials</a>
@endsection

@section('content')
    <h3 class="page-title"> Serials
        <small>Insert</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('serial.store') }}" class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.serial._form')

                        @include('backend.common.actionForm')

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection