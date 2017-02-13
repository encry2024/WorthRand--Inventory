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
                <a href="{{ route('admin_project_show', $project->id) }}" class="list-group-item " style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;ADD PRICING HISTORY FOR {{ strtoupper($project->name) }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
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
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>
                                </div>
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

                        <div style="margin-left: 27.65rem;">
                            <button class="btn btn-success" onclick='document.getElementById("addProjectPricingHistoryForm").submit();'><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Pricing History</button>
                            <button class="btn btn-danger clear_input"><i class="fa fa-times"></i>&nbsp; Clear</button>
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

        $("#price").on("focusout", function(e) {
            e.preventDefault();
            var projectPricingHistory = document.getElementById("price").value
                     string = numeral(projectPricingHistory).format('0,0.00');

            document.getElementById("price").value = string;
        });
    </script>
@endsection
