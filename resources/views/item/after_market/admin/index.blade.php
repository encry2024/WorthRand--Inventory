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
                                AFTERMARKET
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('create_after_market') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add AfterMarket</a>
                        </div>
                    </div>
                    <br>

                    @if(count($aftermarkets) != 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Material Number</th>
                                        <th>Tag Number</th>
                                        <th>Drawing Number</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($aftermarkets as $aftermarket)
                                        <tr>
                                            <td>{{ $aftermarket->id }}</td>
                                            <td>{{ $aftermarket->name }}</td>
                                            <td>{{ $aftermarket->model }}</td>
                                            <td>{{ $aftermarket->serial_number }}</td>
                                            <td>{{ $aftermarket->tag_number }}</td>
                                            <td>{{ $aftermarket->drawing_number }}</td>
                                            <td>{{ date('F d, Y', strtotime($aftermarket->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin_after_market_show', $aftermarket->id) }}" class="btn btn-sm btn-success">View Aftermarket</a>
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
                                <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">You have 0 records for Aftermarkets.</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
