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
                <a href="{{ route('admin_sales_engineer_index') }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($sales_engineer->name) }}</h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">Information</a></li>
                <li role="presentation"><a href="#engineer_customer" aria-controls="engineer_customer" role="tab" data-toggle="tab">Customers</a></li>
                <li role="presentation"><a href="#target_revenue" aria-controls="target_revenue" role="tab" data-toggle="tab">Target Revenue</a></li>
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#SetTargetSaleModal"><i class="fa fa-edit"></i>&nbsp;Set Target Sale</a></li>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#assignCustomerToSalesEngineerModal"><i class="fa fa-user-plus"></i>&nbsp;Assign Customer</a></li>
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
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $sales_engineer->name }}" disabled autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address:</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $sales_engineer->email }}" disabled autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="engineer_customer">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Company Name</th>
                                        <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach($sales_engineer->customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="target_revenue">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="targetSale">Target Sale</label>
                                <div class="input-group">
                                    <div class="input-group-addon">PHP</div>
                                    <input type="text" class="form-control" name="target_sale" id="targetSale" value="{{ count($sales_engineer->target_revenue) == 0 ? '0.00' : number_format($sales_engineer->target_revenue->target_sale, 2) }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="targetSale">Current Sale</label>
                                <div class="input-group">
                                    <div class="input-group-addon">PHP</div>
                                    <input type="text" class="form-control" name="target_sale" id="targetSale" value="{{ count($targetRevenueHistory->total_sales) == "" ? '0.00' : number_format($targetRevenueHistory->total_sales, 2) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="assignCustomerToSalesEngineerModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Assign Customer</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="assignCustomerToUser" method="POST" action="{{ route('admin_save_customer') }}" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <label for="customer_dropdown" class="col-md-4 control-label">Assign Customer</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="item" id="customer_dropdown" required autofocus />
                                <input type="hidden" name="customer_id" id="customer_id">
                                <input type="hidden" name="user_id" value="{{ $sales_engineer->id }} ">

                                @if ($errors->has('customer_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" OnClick='document.getElementById("assignCustomerToUser").submit();'>Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="SetTargetSaleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Target Sale Revenue</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="SetTargetRevenueToUser" method="POST" action="{{ route('admin_set_se_target_revenue', $sales_engineer->id) }}" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('target_sale') ? ' has-error' : '' }}">
                            <label for="customer_dropdown" class="col-md-4 control-label">Target Sale Revenue</label>
                            <div class="col-md-6">
                                <input id="target_sale" type="text" class="form-control" name="target_sale" value="{{ count($sales_engineer->target_revenue) == 0 ? '0.00' : $sales_engineer->target_revenue->target_sale }}" autofocus>
                                <input type="hidden" name="user_id" value="{{ $sales_engineer->id }} ">

                                @if ($errors->has('target_sale'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('target_sale') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" OnClick='document.getElementById("SetTargetRevenueToUser").submit();'>Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $('#customer_dropdown').autocomplete({
            serviceUrl: "{{ URL::to('/') }}/{{ Auth::user()->role }}/fetch_customers/",
            dataType: 'json',
            type: 'get',
            onSelect: function (suggestions) {
                document.getElementById('customer_id').value = suggestions.data;
            }
        });
    </script>
@endsection
