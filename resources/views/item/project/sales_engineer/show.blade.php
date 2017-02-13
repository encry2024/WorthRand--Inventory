@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('se_project_index') }}" class="list-group-item {!! Request::route()->getName() == 'se_dashboard' ? 'active' : '' !!}" style="font-size: 13px;">
                        <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
                    </a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($project->name) }}</h4>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> Information</a></li>
                    <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><i class="fa fa-history" aria-hidden="true"></i> Pricing History</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="information">
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-horizontal">
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name:</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $project->name }}" disabled autofocus>

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
                                            <input id="model" type="text" class="form-control" name="model" value="{{ $project->model }}" disabled autofocus>

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
                                            <input id="ccn_number" type="text" class="form-control" name="ccn_number" value="{{ $project->ccn_number }}" disabled autofocus>

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
                                            <input id="part_number" type="text" class="form-control" name="part_number" value="{{ $project->part_number }}" disabled autofocus>

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
                                            <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ $project->reference_number }}" disabled autofocus>

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
                                            <input id="material_number" type="text" class="form-control" name="material_number" value="{{ $project->material_number }}" disabled autofocus>

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
                                            <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $project->serial_number }}" disabled autofocus>

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
                                            <input id="tag_number" type="text" class="form-control" name="tag_number" value="{{ $project->tag_number }}" disabled autofocus>

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
                                            <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ $project->drawing_number }}" disabled autofocus>

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
                    <div role="tabpanel" class="tab-pane fade in" id="pricing_history">
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
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
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">WPC Reference</th>
                                        </thead>

                                        <tbody>
                                        @foreach($project->project_pricing_history as $pricing_history)
                                            <tr>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($pricing_history->created_at)) }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->po_number }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->pricing_date }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ number_format($pricing_history->price, 2) }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->terms }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->delivery }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->fpd_reference }}</b></td>
                                                <td style="border: none; border-bottom: 1px solid #ddd;" class="text-right"><b>{{ $pricing_history->wpc_reference }}</b></td>
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
