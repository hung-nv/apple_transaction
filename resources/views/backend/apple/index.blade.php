@extends('backend.layouts.app')

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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
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
                            <div class="col-md-6 pull-right text-right">
                                <a class="btn sbold red" href="{{ route('apple.deleteAll') }}"
                                   onclick="return confirm('Do you want to delete all?');"> Delete All
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="data-apple">
                        <thead>
                        <tr>
                            <th width="8%"> <input type="checkbox" v-on:click="selectAll" > All </th>
                            <th> Apple ID</th>
                            <th> Password</th>
                            <th> iPhone Internal Name</th>
                            <th> iPhone Identify</th>
                            <th> iPhone Model</th>
                            <th> Total add infor fail</th>
                            <th> Used</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($data))
                            @foreach($data as $i)

                                <tr class="odd gradeX">
                                    <td><input type="checkbox" data-id="{{ $i->id }}" v-on:click="selectIdApple"></td>
                                    <td>{{ $i->email }}</td>
                                    <td>{{ $i->password }}</td>
                                    <td>{{ $i->iphone_internal_name }}</td>
                                    <td>{{ $i->iphone_identify }}</td>
                                    <td>{{ $i->iphone_model }}</td>
                                    <td>{{ $i->total_fail }}</td>
                                    <td>
                                        @if($i->is_used === 0)
                                            <span class="badge badge-info badge-roundless"> No </span>
                                        @else
                                            <span class="badge badge-default badge-roundless"> Yes </span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('apple.destroy', $i->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="button" class="btn red btn-sm" v-on:click="confirmDelete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>

                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection