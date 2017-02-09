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
                            <h4><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;SALES ENGINEER</h4>
                        </div>
                    </div>
                </div>
                
                @if(count($seals) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin_seal_create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Seal</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">#</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Seal Type</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Material Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Actions</th>
                                </thead>
                                <tbody>
                                @foreach($seals as $seal)
                                    <tr>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ ((($seals->currentPage() - 1) * $seals->perPage()) + ($ctr++) + 1) }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ $seal->name }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ $seal->model }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ $seal->seal_type }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ $seal->model }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ $seal->material_number }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;">{{ date('F d, Y', strtotime($seal->created_at)) }}</td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;" class="text-right">
                                            <a href="{{ route('admin_seal_show', $seal->id) }}" class="btn btn-sm btn-success">View Seal</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $seals->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert search-error" role="alert"><b>You have 0 records for Seals.</b></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
