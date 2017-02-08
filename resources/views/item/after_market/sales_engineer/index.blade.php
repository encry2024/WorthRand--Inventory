@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('layouts.se-sidebar')
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;AFTERMARKETS</h4>
                        </div>
                    </div>
                </div>

                @if(count($aftermarkets) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Project</th>
                                        <th>Material Number</th>
                                        <th>Tag Number</th>
                                        <th>Drawing Number</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($aftermarkets as $aftermarket)
                                        <tr>
                                            <td>{{ $aftermarket->id }}</td>
                                            <td>{{ $aftermarket->name }}</td>
                                            <td>{{ $aftermarket->project->name }}</td>
                                            <td>{{ $aftermarket->model }}</td>
                                            <td>{{ $aftermarket->serial_number }}</td>
                                            <td>{{ $aftermarket->tag_number }}</td>
                                            <td>{{ $aftermarket->drawing_number }}</td>
                                            <td>
                                                <a href="{{ route('se_aftermarket_show', $aftermarket->id) }}" class="btn btn-sm btn-success">View Aftermarket</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert search-error" role="alert"><b>There are no currently available Aftermarkets</b></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
