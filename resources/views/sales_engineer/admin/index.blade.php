@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12">
            @include('layouts.admin-sidebar')
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;SALES ENGINEER</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">E-mail</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->id }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->name }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $user->email }}</b></td>
                                        <td class="text-right">
                                            <a href="{{ route('admin_show_sales_engineer', $user->id) }}" class="btn btn-sm btn-primary">View Profile</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form class="form-inline">
                                <div class="form-group left" style=" margin-top: 2.55rem; ">
                                    <label class="" for="">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} out of {{ $users->total() }} Sales Engineer(s)</label>
                                </div>
                                {{-- <div class="form-group right">
                                    <span class="right">{!! $users->appends(['filter' => Request::get('filter')])->render() !!}</span>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
