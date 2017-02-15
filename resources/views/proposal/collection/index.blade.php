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
                                INDENTED PROPOSALS
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <th>ID</th>
                                        <th>Purchase Order</th>
                                        <th>To</th>
                                        <th>Sold To</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                        </thead>
                                        <tbody>
                                        @foreach($indented_proposals as $indented_proposal)
                                            <tr>
                                                <td>{{ $indented_proposal->id }}</td>
                                                <td>{{ $indented_proposal->purchase_order }}</td>
                                                <td>{{ $indented_proposal->customer->name }}</td>
                                                <td>{{ $indented_proposal->branch->name }}</td>
                                                <td>{{ $indented_proposal->collection_status }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin_show_pending_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
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
    </div>
@endsection
