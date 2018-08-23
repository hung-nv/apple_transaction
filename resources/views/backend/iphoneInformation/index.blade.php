@extends('backend.layouts.app')

@section('title', 'Manage Iphone Information')

@section('pageId', 'iPhoneInformation')

@section('breadcrumbs')
    <a href="{{ route('iphoneInformation.index') }}">Iphone Informations</a>
@endsection

@section('content')
    <h3 class="page-title"> Iphone Information
        <small>All</small>
    </h3>

    @include('backend.blocks.message')

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
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a class="btn sbold green" href="{{ route('iphoneInformation.create') }}"> Insert
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 pull-right text-right hidden">
                                <a class="btn sbold red" href="{{ route('iphoneInformation.deleteAll') }}"
                                   onclick="return confirm('Do you want to delete all?');"> Delete All
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="data-iphoneInformation">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Internal Name</th>
                            <th> Identify</th>
                            <th style="width: 50%;"> Models</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($iphoneInformations))
                            @foreach($iphoneInformations as $i)

                                <tr class="odd gradeX">
                                    <td> {{ $i->id }}</td>
                                    <td>{{ $i->internal_name }}</td>
                                    <td>{{ $i->identify }}</td>
                                    <td>{{ $i->iphoneInformationModels->implode('iphone_model', ', ') }}</td>
                                    <td>
                                        <form action="{{ route('iphoneInformation.destroy', ['iphoneInformation' => $i->id]) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="{{ route('iphoneInformation.copy', ['id' => $i->id]) }}" class="btn red btn-sm">Copy and edit</a>
                                            <a href="{{ route('iphoneInformation.edit', ['iphoneInformation' => $i->id]) }}"
                                               class="btn red btn-sm">Update</a>
                                            <button type="button" class="btn red btn-sm" v-on:click="confirmDelete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>

                    {{ $iphoneInformations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection