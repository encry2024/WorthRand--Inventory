@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('layouts.admin-sidebar')

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle"></i> ITEMS
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="dropdown pull-right">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Actions
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.25rem;">
                                <li><a href="{{ route('admin_create_group') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Add Group</a></li>
                                <li><a href="{{ route('create_project') }}"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Add Project</a></li>
                                <li><a href="{{ route('create_after_market') }}"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Add Aftermarket</a></li>
                                <li><a href="{{ route('admin_create_user') }}"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;Add Seal</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-right">Actions</th>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td class="text-center">{{ $group->name }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm btn-success">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
