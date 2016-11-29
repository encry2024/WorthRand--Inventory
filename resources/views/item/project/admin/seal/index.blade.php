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
                                SEAL LIST
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('admin_seal_create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Seal</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Seal Type</th>
                                        <th>Model</th>
                                        <th>Material Number</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($seals as $seal)
                                        <tr>
                                            <td>{{ $seal->id }}</td>
                                            <td>{{ $seal->name }}</td>
                                            <td>{{ $seal->model }}</td>
                                            <td>{{ $seal->seal_type }}</td>
                                            <td>{{ $seal->model }}</td>
                                            <td>{{ $seal->material_number }}</td>
                                            <td>
                                                <a href="{{ route('admin_seal_show', $seal->id) }}" class="btn btn-sm btn-success">View Seal</a>
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
    </div>
@endsection
