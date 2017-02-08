@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @include('layouts.admin-sidebar')

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-cog"></i>&nbsp;&nbsp;PROJECTS</h4>
                        </div>
                    </div>
                </div>

                @if(count($projects) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('create_project') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Project</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Serial Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Tag Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Drawing Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Created</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->id }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->name }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->model }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->serial_number }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->tag_number }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $project->drawing_number }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ date('m/d/Y', strtotime($project->created_at)) }}</td>
                                            <td class="text-right">
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
                            <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;"><b>You have 0 records for Projects.</b></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
