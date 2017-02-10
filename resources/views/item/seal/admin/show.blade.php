@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin_seal_index') }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>
        
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                    <h4><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;{{ strtoupper($seal->name) }}</h4>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><b>Information</b></a></li>
                <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><b>Pricing History</b></a></li>
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Actions
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
                        <li><a href="{{ route('admin_seal_information', $seal->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit Information</a></li>
                        <li><a href="{{ route('admin_seal_pricing_history_create', $seal->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
                    </ul>
                </div>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="information">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name:</label>

                                    <div class="col-md-6">
                                        <label id="name" class="control-label" name="name">{{ $seal->name }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="price" class="col-md-4 control-label">Price:</label>

                                    <div class="col-md-6">
                                        <label id="price" class="control-label" name="price">{{ number_format($seal->price, 2) }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                                    <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                                    <div class="col-md-6">
                                        <label id="drawing_number" class="control-label" name="drawing_number">{{ $seal->drawing_number }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('bom_number') ? ' has-error' : '' }}">
                                    <label for="bom_number" class="col-md-4 control-label">BOM Number:</label>

                                    <div class="col-md-6">
                                        <label id="bom_number" class="control-label" name="bom_number">{{ $seal->bom_number }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('end_user') ? ' has-error' : '' }}">
                                    <label for="end_user" class="col-md-4 control-label">End User:</label>

                                    <div class="col-md-6">
                                        <label id="end_user" class="control-label" name="end_user">{{ $seal->end_user }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('seal_type') ? ' has-error' : '' }}">
                                    <label for="seal_type" class="col-md-4 control-label">Seal Type:</label>

                                    <div class="col-md-6">
                                        <label id="seal_type" class="control-label" name="seal_type">{{ $seal->seal_type }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                                    <label for="size" class="col-md-4 control-label">Size:</label>

                                    <div class="col-md-6">
                                        <label id="size" class="control-label" name="size">{{ $seal->size }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('material_code') ? ' has-error' : '' }}">
                                    <label for="material_code" class="col-md-4 control-label">Material Number:</label>

                                    <div class="col-md-6">
                                        <label id="material_code" class="control-label" name="material_code">{{ $seal->material_number }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-4 control-label">Code:</label>

                                    <div class="col-md-6">
                                        <label id="code" class="control-label" name="code">{{ $seal->code }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                                    <label for="model" class="col-md-4 control-label">Model:</label>

                                    <div class="col-md-6">
                                        <label id="model" class="control-label" name="model">{{ $seal->model }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                                    <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                                    <div class="col-md-6">
                                        <label id="serial_number" class="control-label" name="serial_number">{{ $seal->serial_number }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                                    <label for="tag" class="col-md-4 control-label">Tag:</label>

                                    <div class="col-md-6">
                                        <label id="tag" class="control-label" name="tag">{{ $seal->tag }}</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="pricing_history">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                        @if(count($seal->seal_pricing_history) != 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Created</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">P.O Number</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Year</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Price ($)</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Terms</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Delivery</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">FPD Reference</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">WPC Reference</th>
                                    </thead>

                                    <tbody>
                                    @foreach($seal->seal_pricing_history as $pricing_history)
                                        <tr>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($pricing_history->created_at)) }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->po_number }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->pricing_date }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ number_format($pricing_history->price, 2) }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->terms }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->delivery }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->fpd_reference }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->wpc_reference }}</b></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert search-error" role="alert"><b>You have 0 records for {{ $seal->name }}'s Pricing History.</b></div>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
