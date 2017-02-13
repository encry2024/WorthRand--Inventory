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
                        <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;AFTERMARKETS</h4>
                    </div>
                </div>
            </div>

            @if(count($aftermarkets) != 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">#</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Material Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Tag Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Drawing Number</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Actions</th>
                            </thead>
                            <tbody>
                            @foreach($aftermarkets as $aftermarket)
                                <tr>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->id }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->name }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->model }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->serial_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->tag_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $aftermarket->drawing_number }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;">
                                        <a href="{{ route('se_aftermarket_show', $aftermarket->id) }}" class="btn btn-sm btn-success">View Aftermarket</a>
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
                        <div class="alert search-error" role="alert"><b>There are no currently available Aftermarkets</b></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
