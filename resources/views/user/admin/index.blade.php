@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('layouts.admin-sidebar')
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="panel panel-default" style="border-top: saddlebrown 3px solid;">
                        <div class="panel-heading">
                        <h4><i class="fa fa-users"></i>&nbsp;&nbsp;USERS</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin_create_user') }}" class="btn btn-success"><i class="fa fa-user-plus"></i> Add Users</a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">E-mail</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Role</th>
                                    <th class="text-right" style="background-color: #428bca; color: white;" >Actions</th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->id }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->name }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->email }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ ucfirst($user->role) }}</b></td>
                                        <td class="text-right">
                                            <a href="{{ route('show_user_profile', $user->id) }}" class="btn btn-sm btn-primary">View Profile</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
