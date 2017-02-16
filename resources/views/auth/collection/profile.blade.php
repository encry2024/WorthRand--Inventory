@extends('layouts.app')


@section('content')
    @if(Session::has('message'))
        <div class="row" style="margin-top: -2rem;">
            <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
                <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    @endif

    <div class="col-lg-12">
        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('collection_dashboard') }}" class="list-group-item" style="font-size: 13px;">
                        <i class="fa fa-th-large" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard
                    </a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;PROFILE</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route(Auth::user()->role . '_update_profile') }}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="name" class="control-label col-sm-2">Name:</label>
                            <div class="col-lg-6">
                                <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label col-sm-2" required>E-mail:</label>
                            <div class="col-lg-6">
                                <input name="email" type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required>
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

                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-2">
                                <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Update Profile</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop