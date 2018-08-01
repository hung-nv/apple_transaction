@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Manage users
@endsection

@section('pageId', 'users')

@section('breadcrumbs')
    <a href="{{ route('user.index') }}">Users</a>
@endsection

@section('content')
    <h3 class="page-title"> Managed users
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
                                    <a class="btn sbold green" href="{{ route('user.create') }}"> Add New
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="data-users">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Username</th>
                            <th> Name</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($data))
                            @foreach($data as $i)

                                <tr class="odd gradeX">
                                    <td> {{ $i->id }}</td>
                                    <td>{{ $i->username }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>
                                        <form action="{{ route('user.destroy', $i->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="{{ route('user.edit', ['user' => $i->id]) }}"
                                               class="btn red btn-sm">Update</a>
                                            <button type="button" class="btn red btn-sm btn-delete"
                                                    v-on:click="confirmDelete">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection