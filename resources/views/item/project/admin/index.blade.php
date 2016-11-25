@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                @include('layouts.admin-sidebar')
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                PROJECT
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('create_project') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Project</a>
                        </div>
                    </div>
                    <br>

                    @if(count($projects) != 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Serial Number</th>
                                        <th>Tag Number</th>
                                        <th>Drawing Number</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->id }}</td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->model }}</td>
                                            <td>{{ $project->serial_number }}</td>
                                            <td>{{ $project->tag_number }}</td>
                                            <td>{{ $project->drawing_number }}</td>
                                            <td>{{ date('F d, Y', strtotime($project->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin_project_show', $project->id) }}" class="btn btn-sm btn-success">View Project</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">You have 0 records for Projects.</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
