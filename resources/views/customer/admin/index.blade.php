@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('layouts.admin-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;CUSTOMERS</h4>
                    </div>
                </div>
            </div>

            @if(count($customers) != 0)
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin_customer_create') }}"><span class="glyphicon glyphicon-plus-sign"></span> Add Customer</a>
                    <hr>
                    <div class="table-reponsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Added</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Address</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">City</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Postal Code</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right" >Actions</th>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ ((($customers->currentPage() - 1) * $customers->perPage()) + ($ctr++) + 1) }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($customer->created_at)) }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->name }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->address }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->city }}</b></td>
                                    <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->postal_code }}</b></td>
                                    <td class="text-right"><a href="{{ route('admin_show_customer', $customer->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert search-error" role="alert"><b>You have 0 records for Customers.</b></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
