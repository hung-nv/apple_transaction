@extends('backend.layouts.app')

@section('title', 'Manage Credit Card')

@section('pageId', 'creditCard')

@section('breadcrumbs')
    <a href="{{ route('creditCard.index') }}">Credit Cards</a>
@endsection

@section('content')
    <h3 class="page-title"> Credit Cards
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
                                    <a class="btn sbold green" href="{{ route('creditCard.create') }}">
                                        Insert
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 pull-right text-right">
                                <a class="btn sbold red" href="{{ route('creditCard.deleteAll') }}"
                                   onclick="return confirm('Do you want to delete all?');"> Delete All
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="data-creditCard">
                        <thead>
                        <tr>
                            <th> ID </th>
                            <th> Number</th>
                            <th> Used</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($data))
                            @foreach($data as $i)

                                <tr class="odd gradeX">
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->number }}</td>
                                    <td>
                                        @if($i->is_used === 0)
                                            <span class="badge badge-info badge-roundless"> No </span>
                                        @else
                                            <span class="badge badge-default badge-roundless"> Yes </span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('creditCard.destroy', $i->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="button" class="btn red btn-xs" v-on:click="confirmDelete">Delete</button>
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