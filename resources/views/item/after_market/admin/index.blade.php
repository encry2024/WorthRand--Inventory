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

                @if(count($aftermarkets) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('create_after_market') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add AfterMarket</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">#</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Model</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Material Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Tag Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Drawing Number</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
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
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('F d, Y', strtotime($aftermarket->created_at)) }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;" class="text-right">
                                            <a href="{{ route('admin_after_market_show', $aftermarket->id) }}" class="btn btn-sm btn-success">View Aftermarket</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form class="form-inline">
                                <div class="form-group left" style=" margin-top: 2.55rem; ">
                                    <label class="" for="">Showing {{ $aftermarkets->firstItem() }} to {{ $aftermarkets->lastItem() }} out of {{ $aftermarkets->total() }} After Market(s)</label>
                                </div>
                                {{-- <div class="form-group right">
                                    <span class="right">{!! $aftermarkets->appends(['filter' => Request::get('filter')])->render() !!}</span>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert search-error" role="alert" ><b>You have 0 records for Aftermarkets.</b></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
