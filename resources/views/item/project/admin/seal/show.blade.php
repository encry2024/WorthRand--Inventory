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
                            <li class="nav-item"><a class="nav-link"  href="{{ route('admin_seal_show', $seal->id) }}"><i class="fa fa-cog"></i>&nbsp; {{ $seal->name }}</a>
                                <ul class="sub">
                                    <li><a href="{{ route('admin_seal_show', $seal->id) }}"><i class="fa fa-cog"></i>&nbsp;Profile</a></li>
                                    <li><a href="{{ route('admin_seal_information', $seal->id) }}"><i class="fa fa-pencil"></i>&nbsp;Update Information</a></li>
                                </ul>
                            </li>
                        </li>

                        <li>
                            <li class="nav-item"><a class="nav-link"  href="#"><i class="fa fa-th-list"></i>&nbsp; Pricing History</a>
                                <ul class="sub">
                                    <li><a href="{{ route('admin_after_market_pricing_history_index', $seal->id) }}"><i class="fa fa-th-list"></i>&nbsp;Pricing History List</a></li>
                                    <li class="nav-item"><a class="nav-link"  href="{{ route('admin_seal_pricing_history_create', $seal->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
                                </ul>
                            </li>
                        </li>


                        <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_index') }}"><i class="fa fa-arrow-left"></i>&nbsp; back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ strtoupper($seal->name) }}
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
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ $seal->name }}" disabled autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                                                <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                                                <div class="col-md-6">
                                                    <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ $seal->drawing_number }}" disabled autofocus>

                                                    @if ($errors->has('drawing_number'))
                                                        <span class="help-block">
                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('bom_number') ? ' has-error' : '' }}">
                                                <label for="bom_number" class="col-md-4 control-label">BOM Number:</label>

                                                <div class="col-md-6">
                                                    <input id="bom_number" type="text" class="form-control" name="bom_number" value="{{ $seal->bom_number }}" disabled autofocus>

                                                    @if ($errors->has('bom_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bom_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('end_user') ? ' has-error' : '' }}">
                                                <label for="end_user" class="col-md-4 control-label">End User:</label>

                                                <div class="col-md-6">
                                                    <input id="end_user" type="text" class="form-control" name="end_user" value="{{ $seal->end_user }}" disabled autofocus>

                                                    @if ($errors->has('end_user'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('end_user') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('seal_type') ? ' has-error' : '' }}">
                                                <label for="seal_type" class="col-md-4 control-label">Seal Type:</label>

                                                <div class="col-md-6">
                                                    <input id="seal_type" type="text" class="form-control" name="seal_type" value="{{ $seal->seal_type }}" disabled autofocus>

                                                    @if ($errors->has('seal_type'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('seal_type') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                                                <label for="size" class="col-md-4 control-label">Size:</label>

                                                <div class="col-md-6">
                                                    <input id="size" type="text" class="form-control" name="size" value="{{ $seal->size }}" disabled autofocus>

                                                    @if ($errors->has('size'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('size') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('material_code') ? ' has-error' : '' }}">
                                                <label for="material_code" class="col-md-4 control-label">Material Number:</label>

                                                <div class="col-md-6">
                                                    <input id="material_code" type="text" class="form-control" name="material_code" value="{{ $seal->material_code }}" disabled autofocus>

                                                    @if ($errors->has('material_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('material_code') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                                <label for="code" class="col-md-4 control-label">Code:</label>

                                                <div class="col-md-6">
                                                    <input id="code" type="text" class="form-control" name="code" value="{{ $seal->code }}" disabled autofocus>

                                                    @if ($errors->has('code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('code') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                                                <label for="model" class="col-md-4 control-label">Model:</label>

                                                <div class="col-md-6">
                                                    <input id="model" type="text" class="form-control" name="model" value="{{ $seal->model }}" disabled autofocus>

                                                    @if ($errors->has('model'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('model') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                                                <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                                                <div class="col-md-6">
                                                    <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $seal->serial_number }}" disabled autofocus>

                                                    @if ($errors->has('serial_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('serial_number') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                                                <label for="tag" class="col-md-4 control-label">Tag:</label>

                                                <div class="col-md-6">
                                                    <input id="tag" type="text" class="form-control" name="tag" value="{{ $seal->tag }}" disabled autofocus>

                                                    @if ($errors->has('tag'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('tag') }}</strong>
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
