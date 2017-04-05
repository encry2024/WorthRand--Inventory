@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            @include('layouts.admin-sidebar')
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
               @if(Session::has('message'))
               <div class="row">
                  <div class="alert alert-success alert-dismissible" role="alert">
                     <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
                        <button type="button" class="close" style="margin-right: -1.3rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                     </div>
                  </div>
                  @endif

                  <div class="row">
                     <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                           <h4><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;ADD USER</h4>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-12">
                        <a class="btn btn-success" href="#" onclick='document.getElementById("createUserForm").submit();'><i class="fa fa-check"></i>&nbsp; Create User</a>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                           <div class="panel-body">
                              <form class="form-horizontal" id="createUserForm" action="{{ route('post_create_user') }}" method="POST">
                                 {{ csrf_field() }}

                                 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                       <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                       @if ($errors->has('name'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                       @if ($errors->has('email'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                       <input id="password" type="password" class="form-control" name="password" required>

                                       @if ($errors->has('password'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                       @if ($errors->has('password_confirmation'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="inputChildren" class="col-sm-4 control-label">Choose User Role:</label>
                                    <div class="col-sm-6">
                                       <select class="form-control" name="role">
                                          <option value="sales_engineer">Sales Engineer</option>
                                          <option value="collection">Collection</option>
                                          <option value="assistant">Assistant</option>
                                       </select>

                                       @if ($errors->has('role'))
                                       <span class="help-block">
                                          <strong>{{ $errors->first('role') }}</strong>
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
