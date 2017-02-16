@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12">
        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('collection_dashboard') }}" class="list-group-item {{ Request::route()->getName() == 'collection_dashboard' ? 'active' : '' }}" style="font-size: 13px;"><i class="fa fa-th-large"></i>&nbsp;&nbsp;Dashboard</a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                            <i class="fa fa-th-large"></i>&nbsp;&nbsp;DASHBOARD
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#indented_proposal" aria-controls="indented_proposal" role="tab" data-toggle="tab">Indented Proposal</a></li>
                    <li role="presentation"><a href="#buy_and_resale_proposal" aria-controls="buy_and_resale_proposal" role="tab" data-toggle="tab">Buy and Resale Proposal</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="indented_proposal">
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                @if(count($indented_proposals) != 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Received</th>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Purchase Order</th>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Sold To</th>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Submitted By</th>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Status</th>
                                                <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                            </thead>

                                            <tbody>
                                            @foreach($indented_proposals as $indented_proposal)
                                                <tr style="font-weight: bold;">
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">{{ date('m/d/Y', strtotime($indented_proposal->created_at)) }}</td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">@if($indented_proposal->purchase_order == '')
                                                            <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                        @else
                                                            {{ $indented_proposal->purchase_order }}
                                                        @endif
                                                    </td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">
                                                        @if($indented_proposal->customer_id == 0)
                                                            <span class='label label-danger'>Draft Proposal</span>
                                                        @else
                                                            {{ $indented_proposal->customer->name }}
                                                        @endif
                                                    </td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">{{ $indented_proposal->user->name }}</td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">
                                                        @if($indented_proposal->collection_status == "PENDING" || $indented_proposal->collection_status == "ON-CREATE")
                                                            <span style="font-size: 12px;" class="label label-warning">{{ $indented_proposal->collection_status }}</span>
                                                        @elseif($indented_proposal->collection_status == "DECLINED" || $indented_proposal->collection_status == "DELAYED")
                                                            <span style="font-size: 12px;" class="label label-danger">{{ $indented_proposal->collection_status }}</span>
                                                        @elseif($indented_proposal->collection_status == "DELIVERY")
                                                            <span style="font-size: 12px;" class="label label-primary">{{ $indented_proposal->collection_status }}</span>
                                                        @else
                                                            <span style="font-size: 12px;" class="label label-success">{{ $indented_proposal->collection_status }}</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-right">
                                                        @if($indented_proposal->collection_status == "COMPLETED")
                                                            <a href="{{ route('collection_view_completed_indented_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View</a>
                                                        @else
                                                            <a href="{{ route('for_collection', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert search-error" role="alert">You Have 0 Records For Indented Proposals.</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade in " id="buy_and_resale_proposal">
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                @if(count($buy_and_sell_proposals) != 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">ID</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Purchase Order</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Sold To</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Submitted By</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Status</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Submitted</th>
                                            <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                            </thead>

                                            <tbody>
                                            @foreach($buy_and_sell_proposals as $buy_and_sell_proposal)
                                                <tr style="font-weight: bold;">
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">{{ ((($buy_and_sell_proposals->currentPage() - 1) * $buy_and_sell_proposals->perPage()) + ($ctr2++) + 1) }}</td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">@if($buy_and_sell_proposal->purchase_order == '')
                                                            <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                        @else
                                                            {{ $buy_and_sell_proposal->purchase_order }}
                                                        @endif
                                                    </td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">
                                                        @if($buy_and_sell_proposal->customer_id == 0)
                                                            <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                                        @else
                                                            {{ $buy_and_sell_proposal->customer->name }}
                                                        @endif
                                                    </td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">{{ $indented_proposal->user->name }}</td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">
                                                        @if($buy_and_sell_proposal->collection_status == "PENDING" || $buy_and_sell_proposal->collection_status == "ON-CREATE")
                                                            <span style="font-size: 12px;" class="label label-warning">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @elseif($buy_and_sell_proposal->collection_status == "DECLINED" || $buy_and_sell_proposal->collection_status == "DELAYED")
                                                            <span style="font-size: 12px;" class="label label-danger">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @elseif($buy_and_sell_proposal->collection_status == "DELIVERY")
                                                            <span style="font-size: 12px;" class="label label-primary">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @else
                                                            <span style="font-size: 12px;" class="label label-success">{{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td style="border: none; border-bottom: 1px solid #ddd;">{{ date('F d, Y', strtotime($buy_and_sell_proposal->created_at)) }}</td>
                                                    <td class="text-right">
                                                        @if($buy_and_sell_proposal->collection_status == "PENDING" || $buy_and_sell_proposal->collection_status == "ON-CREATE")
                                                            <span style="font-size: 12px;" class="label label-warning">Item on {{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @elseif($buy_and_sell_proposal->collection_status == "DECLINED" || $buy_and_sell_proposal->collection_status == "DELAYED")
                                                            <span style="font-size: 12px;" class="label label-danger">Item on {{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @elseif($buy_and_sell_proposal->collection_status == "DELIVERY")
                                                            <span style="font-size: 12px;" class="label label-primary">Item on {{ $buy_and_sell_proposal->collection_status }}</span>
                                                        @else
                                                            <a href="{{ route('collection_show_pending_buy_and_sell_proposal', $buy_and_sell_proposal->id) }}" class="btn btn-sm btn-primary">View</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert search-error" role="alert">You Have 0 Records For Buy & Sell Proposals.</div>
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
