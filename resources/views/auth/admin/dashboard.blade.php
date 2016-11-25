@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                @include('layouts.admin-sidebar')
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
                            <div class="panel-heading">
                                DASHBOARD
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div id="chart"></div>
                            {!! $lava->render('PieChart', 'USERS', 'chart') !!}
                        </div>

                        <div class="col-lg-6">
                            <div id="target_sale_div"></div>
                            {!! $target_chart->render('ColumnChart', 'TARGETSALE', 'target_sale_div') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>Indented Proposals</h1>
                            </div>
                            <div class="col-lg-12">
                                @if(count($indented_proposals) != 0)

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Purchase Order</th>
                                            <th>Sold To</th>
                                            <th>Submitted By:</th>
                                            <th>Status</th>
                                            <th>Date Received</th>
                                            <th class="text-right">Actions</th>
                                        </thead>

                                        <tbody>
                                        @foreach($indented_proposals as $indented_proposal)
                                            <tr class="

                                            ">
                                                <td>{{ ((($indented_proposals->currentPage() - 1) * $indented_proposals->perPage()) + ($ctr++) + 1) }}</td>
                                                <td>@if($indented_proposal->purchase_order == '')
                                                        <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                    @else
                                                        {{ $indented_proposal->purchase_order }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($indented_proposal->customer_id == 0)
                                                        <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                    @else
                                                        {{ $indented_proposal->customer->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $indented_proposal->user->name }}</td>
                                                <td>
                                                    @if($indented_proposal->collection_status == "PENDING")
                                                        <span style="font-size: 12px;" class="label label-warning">{{ $indented_proposal->collection_status }}</span>
                                                    @elseif($indented_proposal->collection_status == "DECLINED" || $indented_proposal->collection_status == "DELAYED")
                                                        <span style="font-size: 12px;" class="label label-danger">{{ $indented_proposal->collection_status }}</span>
                                                    @elseif($indented_proposal->collection_status == 'ON-CREATE')
                                                        <span style="font-size: 12px;" class="label label-warning">{{ $indented_proposal->collection_status }}</span>
                                                    @else
                                                        <span style="font-size: 12px;" class="label label-success">{{ $indented_proposal->collection_status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y', strtotime($indented_proposal->created_at)) }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin_show_pending_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $indented_proposals->links() }}
                                @else
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">You Have 0 Records For Indented Proposals.</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>Buy & Resale Proposals</h1>
                            </div>
                            <div class="col-lg-12">
                                @if(count($buy_and_sell_proposals) != 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Purchase Order</th>
                                        <th>Sold To</th>
                                        <th>Submitted By:</th>
                                        <th>Status</th>
                                        <th>Date Received</th>
                                        <th class="text-right">Actions</th>
                                        </thead>

                                        <tbody>
                                        @foreach($buy_and_sell_proposals as $buy_and_sell_proposal)
                                            <tr>
                                                <td>{{ ((($buy_and_sell_proposals->currentPage() - 1) * $buy_and_sell_proposals->perPage()) + ($ctr2++) + 1) }}</td>
                                                <td>@if($buy_and_sell_proposal->purchase_order == '')
                                                        <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                    @else
                                                        {{ $buy_and_sell_proposal->purchase_order }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($buy_and_sell_proposal->customer_id == 0)
                                                        <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                    @else
                                                        {{ $buy_and_sell_proposal->customer->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $buy_and_sell_proposal->user->name }}</td>
                                                <td>
                                                    @if($buy_and_sell_proposal->collection_status == "PENDING")
                                                        <span style="font-size: 12px;" class="label label-warning">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                    @elseif($buy_and_sell_proposal->collection_status == "DECLINED" || $buy_and_sell_proposal->collection_status == "DELAYED")
                                                        <span style="font-size: 12px;" class="label label-danger">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                    @elseif($buy_and_sell_proposal->collection_status == 'ON-CREATE')
                                                        <span style="font-size: 12px;" class="label label-warning">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                    @else
                                                        <span style="font-size: 12px;" class="label label-success">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y', strtotime($buy_and_sell_proposal->created_at)) }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin_show_pending_buy_and_sell_proposal', $buy_and_sell_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $buy_and_sell_proposals->links() }}
                                @else
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">You Have 0 Records For Buy & Sell Proposals.</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
