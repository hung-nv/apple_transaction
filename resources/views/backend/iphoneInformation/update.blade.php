@extends('backend.layouts.app')

@section('title')
    Update Iphone Information
@endsection

@section('breadcrumbs')
    <a href="{{ route('iphoneInformation.index') }}">Iphone Informations</a>
@endsection

@section('content')
    <h3 class="page-title"> Iphone Informations
        <small>Update</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('iphoneInformation.update', ['iphoneInformation' => $data['id']]) }}"
                          class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.iphoneInformation._form')

                        @include('backend.common.actionForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection