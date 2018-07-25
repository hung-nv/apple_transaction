@extends('backend.layouts.app')

@section('title')
    Insert Id Apple
@endsection

@section('breadcrumbs')
    <a href="{{ route('apple.index') }}">Apples</a>
@endsection

@section('content')
    <h3 class="page-title"> Apple ID
        <small>Insert</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('apple.store') }}" class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.apple._form')

                        @include('backend.common.actionForm')

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection