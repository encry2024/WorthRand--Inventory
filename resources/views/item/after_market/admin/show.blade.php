@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">

                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                        <li>
                            <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_show', $afterMarket->id) }}"><i class="fa fa-cog"></i>&nbsp; {{ $afterMarket->name }}</a>
                                <ul class="sub">
                                    <li><a href="{{ route('admin_after_market_show', $afterMarket->id) }}"><i class="fa fa-cog"></i>&nbsp;Profile</a></li>
                                    <li><a href="{{ route('admin_after_market_information', $afterMarket->id) }}"><i class="fa fa-pencil"></i>&nbsp;Update Information</a></li>
                                </ul>
                            </li>
                        </li>

                        <li>
                            <li class="nav-item"><a class="nav-link"  href="#"><i class="fa fa-th-list"></i>&nbsp; Pricing History</a>
                                <ul class="sub">
                                    <li><a href="{{ route('admin_after_market_pricing_history_index', $afterMarket->id) }}"><i class="fa fa-th-list"></i>&nbsp;Pricing History List</a></li>
                                    <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_pricing_history_create', $afterMarket->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
                                </ul>
                            </li>
                        </li>


                        <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_index') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ strtoupper($afterMarket->name) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Name:</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ $afterMarket->name }}" disabled autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                                                <label for="model" class="col-md-4 control-label">Model:</label>

                                                <div class="col-md-6">
                                                    <input id="model" type="text" class="form-control" name="model" value="{{ $afterMarket->model }}" disabled autofocus>

                                                    @if ($errors->has('model'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('model') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('ccn_number') ? ' has-error' : '' }}">
                                                <label for="ccn_number" class="col-md-4 control-label">CCN Number:</label>

                                                <div class="col-md-6">
                                                    <input id="ccn_number" type="text" class="form-control" name="ccn_number" value="{{ $afterMarket->ccn_number }}" disabled autofocus>

                                                    @if ($errors->has('ccn_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ccn_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('part_number') ? ' has-error' : '' }}">
                                                <label for="part_number" class="col-md-4 control-label">Part Number:</label>

                                                <div class="col-md-6">
                                                    <input id="part_number" type="text" class="form-control" name="part_number" value="{{ $afterMarket->part_number }}" disabled autofocus>

                                                    @if ($errors->has('part_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('part_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                                                <label for="reference_number" class="col-md-4 control-label">Reference Number:</label>

                                                <div class="col-md-6">
                                                    <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ $afterMarket->reference_number }}" disabled autofocus>

                                                    @if ($errors->has('reference_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('reference_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                                                <label for="material_number" class="col-md-4 control-label">Material Number:</label>

                                                <div class="col-md-6">
                                                    <input id="material_number" type="text" class="form-control" name="material_number" value="{{ $afterMarket->material_number }}" disabled autofocus>

                                                    @if ($errors->has('material_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('material_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                                                <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                                                <div class="col-md-6">
                                                    <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $afterMarket->serial_number }}" disabled autofocus>

                                                    @if ($errors->has('serial_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('serial_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('tag_number') ? ' has-error' : '' }}">
                                                <label for="tag_number" class="col-md-4 control-label">Tag Number:</label>

                                                <div class="col-md-6">
                                                    <input id="tag_number" type="text" class="form-control" name="tag_number" value="{{ $afterMarket->tag_number }}" disabled autofocus>

                                                    @if ($errors->has('tag_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('tag_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                                                <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                                                <div class="col-md-6">
                                                    <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ $afterMarket->drawing_number }}" disabled autofocus>

                                                    @if ($errors->has('drawing_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('drawing_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
