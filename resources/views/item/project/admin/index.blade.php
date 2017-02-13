@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    @if(Session::has('message'))
        <div class="row" style="margin-top: -2rem;">
            <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
                <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    @endif
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

            <a href="{{ route('create_project') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Project</a>
            <hr>

            @if(count($projects) != 0)
            <div class="row">
                <div class="col-lg-12">
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
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->id }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->name }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->model }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->serial_number }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->tag_number }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $project->drawing_number }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($project->created_at)) }}</b></td>
                                        <td class="text-center">
                                            <a href="{{ route('admin_project_show', $project->id) }}" title="View {{ $project->name }}"><i class="fa fa-search"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form class="form-inline">
                            <div class="form-group left" style=" margin-top: 2.55rem; ">
                                <label class="" for="">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} out of {{ $projects->total() }} Project(s)</label>
                            </div>
                            {{-- <div class="form-group right">
                                <span class="right">{!! $projects->appends(['filter' => Request::get('filter')])->render() !!}</span>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert search-error" role="alert"><b>You have 0 records for Projects.</b></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
