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
                                <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_pricing_history_create', $seal->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
                            </ul>
                        </li>
                        </li>


                        <li class="nav-item"><a class="nav-link"  href="{{ route('admin_after_market_index') }}"><i class="fa fa-arrow-left"></i>&nbsp; back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: -1.3rem; margin-bottom: 1rem; border-radius: 0px 0px 0px 0px;">
                                <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
                                    <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> ADD PRICING HISTORY FOR {{ strtoupper($project->name) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-success" onclick='document.getElementById("addProjectPricingHistoryForm").submit();'><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Pricing History</button>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Item History
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" id="addProjectPricingHistoryForm" action="{{ route('admin_add_project_pricing_history', $project->id) }}" method="POST">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('po_number') ? ' has-error' : '' }}">
                                                    <label for="purchase_order_number" class="col-md-4 control-label">P.O Number:</label>

                                                    <div class="col-md-6">
                                                        <input id="po_number" type="text" class="form-control" name="po_number" value="{{ old('po_number') }}" required autofocus>

                                                        @if ($errors->has('po_number'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('po_number') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('pricing_date') ? ' has-error' : '' }}">
                                                    <label for="pricing_date" class="col-md-4 control-label">Year:</label>

                                                    <div class="col-md-6">
                                                        <input id="pricing_date" type="text" class="form-control" name="pricing_date" value="{{ old('pricing_date') }}" required autofocus>

                                                        @if ($errors->has('pricing_date'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('pricing_date') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                                    <label for="price" class="col-md-4 control-label">Price:</label>

                                                    <div class="col-md-6">
                                                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

                                                        @if ($errors->has('price'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('price') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                                                    <label for="terms" class="col-md-4 control-label">Terms:</label>

                                                    <div class="col-md-6">
                                                        <input id="terms" type="text" class="form-control" name="terms" value="{{ old('terms') }}" required autofocus>

                                                        @if ($errors->has('terms'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('terms') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('delivery') ? ' has-error' : '' }}">
                                                    <label for="delivery" class="col-md-4 control-label">Delivery:</label>

                                                    <div class="col-md-6">
                                                        <input id="delivery" type="text" class="form-control" name="delivery" value="{{ old('delivery') }}" required autofocus>

                                                        @if ($errors->has('delivery'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('delivery') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('fpd_reference') ? ' has-error' : '' }}">
                                                    <label for="fpd_reference" class="col-md-4 control-label">FPD Reference:</label>

                                                    <div class="col-md-6">
                                                        <input id="fpd_reference" type="text" class="form-control" name="fpd_reference" value="{{ old('fpd_reference') }}" required autofocus>

                                                        @if ($errors->has('fpd_reference'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('fpd_reference') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                                                    <label for="wpc_reference" class="col-md-4 control-label">WPC Reference:</label>

                                                    <div class="col-md-6">
                                                        <input id="wpc_reference" type="text" class="form-control" name="wpc_reference" value="{{ old('wpc_reference') }}" required autofocus>

                                                        @if ($errors->has('wpc_reference'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('wpc_reference') }}</strong>
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
    </div>
@endsection
