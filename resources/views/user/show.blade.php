@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked  sidebar-menu">
                        <li class="nav-item {{ Request::route()->getName() == 'secretary_dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('secretary_dashboard') }}" class="nav-link"><i class="fa fa-tachometer"></i>&nbsp; Dashboard</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">

                    @if(Session::has('message'))
                        <div class="row">
                            <div class="alert {{ Session::get('alert') }} alert-dismissible" role="alert" style="margin-top: -1.05rem; border-radius: 0px 0px 0px 0px; font-size: 15px; margin-bottom: 1rem;">
                                <div class="container"><span class="{{ Session::get('msg_icon') }}"></span>&nbsp;{{ Session::get('message') }}
                                    <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">USER PROFILE</div>
                        </div>
                    </div>

                    <div class="row">
                        <form action="{{ route('user_update_profile') }}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label for="name" class="control-label col-sm-2">Name:</label>
                                <div class="col-lg-6">
                                    <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label col-sm-2" required>E-mail:</label>
                                <div class="col-lg-6">
                                    <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label col-sm-2" required>Password:</label>
                                <div class="col-lg-6">
                                    <input name="password" type="password" class="form-control" id="password" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="control-label col-sm-2" required>Password Confirmation:</label>
                                <div class="col-lg-6">
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" >
                                </div>
                            </div>

                            <br><br>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop