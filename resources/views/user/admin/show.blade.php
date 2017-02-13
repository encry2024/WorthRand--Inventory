@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    @if(Session::has('message'))
        <div class="row" style="margin-top: -2rem; margin-left: -15rem; margin-right: -15rem;">
            <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
                <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    @endif

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin_user_index') }}" class="list-group-item" style="font-size: 13px;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                </a>
            </div>
        </div>


        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($user->name) }}</h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;<b>Information</b></a></li>
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Actions
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
                        <li><a href="{{ route('admin_edit_user', $user->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update Account</a></li>
                        <li><a href="#reset_password" onclick="document.getElementById('AdminResetUserPassword').submit();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset Password</a></li>
                        <form action="{{ route('admin_reset_password_user', $user->id) }}" method="POST" id="AdminResetUserPassword">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                        </form>
                        <li><a href="#" class="delete-link"><i class="fa fa-remove"></i>&nbsp;&nbsp;Deactivate User</a></li>
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
                                        <label id="name" class="control-label">{{ $user->name }}</label>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address:</label>

                                    <div class="col-md-6">
                                        <label id="email" class="control-label">{{ $user->email }}</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
