@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin_customer_index') }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($customer->name) }}</h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><b>Information</b></a></li>
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Actions
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
                        <li><a href="{{ route('admin_edit_customer_information', $customer->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Customer</a></li>
                        @if((count($customer->indented_proposals) == 0) && (count($customer->buy_and_sell_proposals) == 0))
                            <li><a style="cursor: pointer;" data-toggle="modal" data-target="#DeleteCustomerModal" class="delete-link"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete Customer</a></li>
                        @else
                            <li class=" disabled"><a><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete Customer</a></li>
                        @endif
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
                                        <label id="name" class="control-label">{{ $customer->name }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">Main Company Address:</label>

                                    <div class="col-md-6">
                                        <label id="address" class="control-label">{{ $customer->address }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label for="city" class="col-md-4 control-label">City:</label>

                                    <div class="col-md-6">
                                        <label id="city" class="control-label">{{ $customer->city }}</label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                    <label for="postal_code" class="col-md-4 control-label">ZIP/Postal Code:</label>

                                    <div class="col-md-6">
                                        <label id="postal_code" class="control-label">{{ $customer->postal_code }}</label>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="DeleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form action="{{ route('admin_delete_customer', $customer->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 0px;">
                    <div class="modal-header modal-header-danger" style="padding: 10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <label class="modal-title" id="myModalLabel" style="font-size: 16px; font-weight: normal;"><i class="fa fa-trash"></i>&nbsp;Delete Customer: {{ $customer->name }}</label>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert" style="border-radius: 0px; padding: 7px; margin-top: -1.6rem; margin-left: -1.5rem; margin-right: -1.5rem; background-image: none;">
                        <label style="margin-left: 2.5rem; padding-top: 2px;"><i class="fa fa-info-circle"></i> You may still recover deleted customers.</label></div>
                        <label class="control-label" style="font-size: 15px;">All proposals that is associated with this customer will also be <code>DELETED.</code><br> Are you sure you want to delete {{ strtoupper($customer->name) }}?</label>
                        <br>
                    </div>
                    <div class="modal-footer" style="padding: 5px; background-color: #e6e6e6; border-top: #ccc solid 1px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
