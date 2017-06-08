@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('layouts.se-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;PROJECTS</h4>
                    </div>
                </div>
            </div>

            @if(count($projects) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Model</th>
                                    <th>Serial Number</th>
                                    <th>Tag Number</th>
                                    <th>Drawing Number</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td><b>{{ $project->id }}</b></td>
                                        <td><b>{{ $project->name }}</b></td>
                                        <td><b>{{ $project->model }}</b></td>
                                        <td><b>{{ $project->serial_number }}</b></td>
                                        <td><b>{{ $project->tag_number }}</b></td>
                                        <td><b>{{ $project->drawing_number }}</b></td>
                                        <td>
                                            <b><a href="{{ route('se_project_show', $project->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a></b>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert search-error" role="alert" >There are no currently available Projects</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
