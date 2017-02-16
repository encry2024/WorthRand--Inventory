@extends('layouts.app')

@section('header')
    @include('layouts.header')
@stop

@section('content')
    <div class="col-lg-12">
        @include('layouts.se-sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                        <h4><i class="fa fa-th-large" aria-hidden="true"></i>&nbsp;&nbsp;DASHBOARD</h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#indented_proposal" aria-controls="indented_proposal" role="tab" data-toggle="tab">Indented Proposal</a></li>
                <li role="presentation"><a href="#buy_and_resale_proposal" aria-controls="buy_and_resale_proposal" role="tab" data-toggle="tab">Buy and Resale Proposal</a></li>
                <li role="presentation"><a href="#target_sale_report" aria-controls="target_sale_report" role="tab" data-toggle="tab">Reports</a></li>
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
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Sent</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Purchase Order</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Sent To</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Proposal Status</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Collection Status</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                    </thead>

                                    <tbody>
                                    @foreach($indented_proposals as $indented_proposal)
                                        <tr style="font-weight: bold;">
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($indented_proposal->created_at)) }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">@if($indented_proposal->purchase_order == '')
                                                    <span class='label label-danger'>Draft Proposal</span>
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
                                            <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $indented_proposal->status }}</b></td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">
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
                                            <td class="text-right">
                                            @if($indented_proposal->status == "SENT")
                                                <a href="{{ route('se_sent_indented_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                            @else
                                                <a href="{{ route('show_draft_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                            @endif
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
                                        <div class="alert alert-danger" role="alert"><b>You Have 0 Records For Indented Proposals.</b></div>
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
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Sent</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Purchase Order</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Sent To</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Proposal Status</th>
                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Collection Status</th>

                                    <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">Actions</th>
                                    </thead>

                                    <tbody>
                                    @foreach($buy_and_sell_proposals as $buy_and_sell_proposal)
                                        <tr style="font-weight: bold;">
                                            <td style="border: none; border-bottom: 1px solid #ddd;">
                                                <b>{{ date('m/d/Y', strtotime($buy_and_sell_proposal->created_at)) }}</b>
                                            </td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">@if($indented_proposal->purchase_order == '')
                                                    <span class='label label-danger'>Draft Proposal</span>
                                                @else
                                                    {{ $buy_and_sell_proposal->purchase_order }}
                                                @endif
                                            </td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">
                                                @if($indented_proposal->customer_id == 0)
                                                    <span class='label label-danger'>Draft Proposal</span>
                                                @else
                                                    {{ $indented_proposal->customer->name }}
                                                @endif
                                            </td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">{{ $buy_and_sell_proposal->status }}</td>
                                            <td style="border: none; border-bottom: 1px solid #ddd;">
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

                                            <td class="text-right">
                                                @if($buy_and_sell_proposal->status == "SENT")
                                                    <a href="{{ route('se_sent_buy_and_sell_proposal', $buy_and_sell_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                                @else
                                                    <a href="{{ route('se_show_draft_buy_and_sell_proposal', $buy_and_sell_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                                @endif
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
                                    <div class="alert alert-danger" role="alert"><b>You Have 0 Records For Buy & Resale Proposals.</b></div>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="target_sale_report">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 for="">Total Project Sold: <b>{{ $project_tally }}</b></h3>
                            <div id="project_chart"></div>
                            {!! $chartForMostSoldProjects->render('PieChart', 'MOSTSOLDPROJECTS', 'project_chart') !!}
                        </div>

                        <div class="col-lg-6">
                            <h3 for="">Total Aftermarket Sold: <b>{{ $aftermarket_tally }}</b></h3>
                            <div id="aftermarket_chart"></div>
                            {!! $chartForMostSoldAftermarket->render('PieChart', 'MOSTSOLDAFTERMARKETS', 'aftermarket_chart') !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
