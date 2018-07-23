@extends('backend.layouts.app')

@section('title')
    Manage Iphone Information
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
                                    <a class="btn sbold green" href="#"> Download
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 pull-right text-right">
                                <a class="btn sbold red" href="#"
                                   onclick="return confirm('Do you want to delete all?');"> Delete All
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="data-apple">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Internal Name</th>
                            <th> Identify</th>
                            <th> Models</th>
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
                                    <td>{{ $i->iphoneInformationModels->implode('model', ',') }}</td>
                                    <td>
                                        <form action="{{ route('iphoneInformation.destroy', $i->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn red btn-sm btn-delete">Delete</button>
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