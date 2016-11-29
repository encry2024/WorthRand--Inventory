@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                @include('layouts.admin-sidebar')

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
                                <i class="fa fa-plus-circle"></i> ADD CUSTOMER
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="#" onclick='document.getElementById("createCustomerForm").submit();'><i class="fa fa-check"></i>&nbsp; Create Customer</a>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" id="createCustomerForm" action="{{ route('post_create_customer') }}" method="POST">
                                        {{ csrf_field() }}

                                        <div class=" form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-lg-pull-1 col-md-5 control-label">Customer Name</label>

                                            <div class="col-lg-pull-1 col-md-7">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class=" form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label for="address" class="col-lg-pull-1 col-md-5 control-label">Address</label>

                                            <div class="col-lg-pull-1 col-md-7">
                                                <textarea id="address" class="form-control" name="address" required></textarea>

                                                @if ($errors->has('address'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class=" form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label for="city" class="col-lg-pull-1 col-md-5 control-label">City</label>

                                            <div class="col-lg-pull-1 col-md-7">
                                                <input id="city" type="text" class="form-control" name="city" required>

                                                @if ($errors->has('city'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class=" form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                            <label for="postal_code" class="col-lg-pull-1 col-md-5 control-label">Postal Code</label>

                                            <div class="col-lg-pull-1 col-md-7">
                                                <input id="postal_code" type="text" class="form-control" name="postal_code" required>

                                                @if ($errors->has('postal_code'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('postal_code') }}</strong>
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
@endsection
