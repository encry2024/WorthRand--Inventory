@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="row">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                        <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                </div>
            </div>
        @endif
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('show_user_profile', $user->id) }}" class="list-group-item" style="font-size: 13px;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back to Profile
                    </a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit Information</h4>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" style="margin-left: 3rem;"><a href="{{ route('admin_edit_user', $user->id) }}" aria-controls="information" role="tab" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Information</a></li>
                    <div class="pull-right">
                        <button class="btn btn-success" style="text-shadow: none !important;" onclick="document.getElementById('UpdateUserForm').submit();">
                            <i class="fa fa-check-circle"></i> Update User
                        </button>
                    </div>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="information">
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-horizontal" action="{{ route('admin_update_user', $user->id) }}" method="POST" id="UpdateUserForm">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name:</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"  autofocus>

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
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}"  autofocus>

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
                </div>

            </div>
        </div>
    </div>
@endsection
