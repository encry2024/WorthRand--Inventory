@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('layouts.se-sidebar')
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <h4><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;MY CUSTOMERS</h4>
                        </div>
                    </div>
                </div>

                @if(count($customers) != 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-reponsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">#</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Name</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Address</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">City</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Postal Code</th>
                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Actions</th>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ ((($customers->currentPage() - 1) * $customers->perPage()) + ($ctr++) + 1) }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->name }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->address }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->city }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $customer->postal_code }}</b></td>
                                        <td style="border: none; border-bottom: 1px solid #ddd;"><a href="{{ route('show_customer', $customer->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $customers->render() }}
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">There are no Customers assigned to you yet.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
