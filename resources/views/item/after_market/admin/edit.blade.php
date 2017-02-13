@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    @if(Session::has('message'))
        <div class="row" style="margin-top: -2rem;">
            <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
                <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin_after_market_show', $afterMarket->id) }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;EDIT {{ strtoupper($afterMarket->name) }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" id="updateAfterMarketForm" action="{{ route('admin_after_market_information_update', $afterMarket->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="aftermarket_id" value="{{ $afterMarket->id }}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $afterMarket->name }}" required autofocus>

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
                                <input id="model" type="text" class="form-control" name="model" value="{{ $afterMarket->model }}" required autofocus>

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
                                <input id="ccn_number" type="text" class="form-control" name="ccn_number" value="{{ $afterMarket->ccn_number }}" required autofocus>

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
                                <input id="part_number" type="text" class="form-control" name="part_number" value="{{ $afterMarket->part_number }}" required autofocus>

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
                                <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ $afterMarket->reference_number }}" required autofocus>

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
                                <input id="material_number" type="text" class="form-control" name="material_number" value="{{ $afterMarket->material_number }}" required autofocus>

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
                                <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $afterMarket->serial_number }}" required autofocus>

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
                                <input id="tag_number" type="text" class="form-control" name="tag_number" value="{{ $afterMarket->tag_number }}" required autofocus>

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
                                <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ $afterMarket->drawing_number }}" required autofocus>

                                @if ($errors->has('drawing_number'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('drawing_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div style="margin-left: 27.5rem;">
                            <button class="btn btn-success" onclick='document.getElementById("updateAfterMarketForm").submit();'><i class="fa fa-edit"></i> Update</button>
                            <button class="btn btn-danger clear_input"><i class="fa fa-remove"></i> Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".clear_input").click(function(e) {
            e.preventDefault();
            $(":input[type='text']").each(function() {
                this.value = "";
            })
        });
    </script>
@endsection
