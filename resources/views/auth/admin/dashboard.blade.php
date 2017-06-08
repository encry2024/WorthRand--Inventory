@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

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
   @include('layouts.admin-sidebar')
   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">

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
         <li role="presentation"><a href="#target_sale_report" aria-controls="target_sale_report" role="tab" data-toggle="tab">Target Sale Report</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane fade in active" id="indented_proposal">
            <br>
            <div class="row">
               <div class="col-lg-12">
                  @if(count($indented_proposals) != 0)

                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <th>ID</th>
                           <th>Purchase Order</th>
                           <th>Sold To</th>
                           <th>Submitted By:</th>
                           <th>Collection Status</th>
                           <th>Date Received</th>
                           <th>Actions</th>
                        </thead>

                        <tbody>
                           @foreach($indented_proposals as $indented_proposal)
                           <tr>
                              <td>{{ $indented_proposal->id }}</td>
                              <td>@if($indented_proposal->purchase_order == '')
                                 <span class='label label-danger'>Draft Proposal</span>
                                 @else
                                 <b>{{ $indented_proposal->purchase_order }}</b>
                                 @endif
                              </td>
                              <td>
                                 @if($indented_proposal->customer_id == 0)
                                 <span class='label label-danger'>Draft Proposal</span>
                                 @else
                                 <b>{{ $indented_proposal->customer->name }}</b>
                                 @endif
                              </td>
                              <td><b>{{ $indented_proposal->user->name }}</b></td>
                              <td>
                                 @if(($indented_proposal->collection_status == "PENDING") || ($indented_proposal->collection_status == 'ON-CREATE'))
                                 <span style="font-size: 12px;" class="label label-warning">{{ $indented_proposal->collection_status }}</span>
                                 @elseif($indented_proposal->collection_status == "DECLINED" || $indented_proposal->collection_status == "DELAYED")
                                 <span style="font-size: 12px;" class="label label-danger">{{ $indented_proposal->collection_status }}</span>
                                 @else
                                 <span style="font-size: 12px;" class="label label-success">{{ $indented_proposal->collection_status }}</span>
                                 @endif
                              </td>
                              <td ><b>{{ date('m/d/Y', strtotime($indented_proposal->created_at)) }}</b></td>
                              <td>
                                 @if($indented_proposal->collection_status == "ON-CREATE")
                                 <span style="font-size: 12px;" class="label label-danger">View Unavailable</span>
                                 @elseif($indented_proposal->collection_status == "COMPLETED")
                                 <a href="{{ route('admin_completed_indented_proposal', $indented_proposal->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                                 @else
                                 <a href="{{ route('admin_show_pending_proposal', $indented_proposal->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
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
                        <div class="alert error" role="alert"><b>You have 0 records for Indented Proposals.</b></div>
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
                     <table class="table table-hover">
                        <thead>
                           <th>ID</th>
                           <th>Purchase Order</th>
                           <th>Sold To</th>
                           <th>Submitted By:</th>
                           <th>Status</th>
                           <th>Date Received</th>
                           <th>Actions</th>
                        </thead>

                        <tbody>
                           @foreach($buy_and_sell_proposals as $buy_and_sell_proposal)
                           <tr style="font-weight: bold;">
                              <td>{{ $buy_and_sell_proposal->id }}</td>
                              <td>@if($buy_and_sell_proposal->purchase_order == '')
                                 <span class='label label-danger'>Draft Proposal</span>
                                 @else
                                 {{ $buy_and_sell_proposal->purchase_order }}
                                 @endif
                              </td>
                              <td>
                                 @if($buy_and_sell_proposal->customer_id == 0)
                                 <span class='label label-danger'>Draft Proposal</span>
                                 @else
                                 {{ $buy_and_sell_proposal->customer->name }}
                                 @endif
                              </td>
                              <td><b>{{ $buy_and_sell_proposal->user->name }}</b></td>
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
                              <td><b>{{ date('m/d/Y', strtotime($buy_and_sell_proposal->created_at)) }}</b></td>
                              <td>
                                 @if($buy_and_sell_proposal->collection_status == "ON-CREATE")
                                 <span style="font-size: 12px;" class="label label-danger">View Unavailable</span>
                                 @else
                                 <a href="{{ route('admin_show_pending_buy_and_sell_proposal', $buy_and_sell_proposal->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></a>
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
                        <div class="alert error" role="alert"><b>You have 0 records for Buy & Resale Proposal.</b></div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane fade in" id="target_sale_report">
            <div class="row">
               <div class="col-lg-12">
                  <div id="target_sale_div"></div>
                  {!! $target_chart->render('ColumnChart', 'TARGETSALE', 'target_sale_div') !!}
               </div>
            </div>
         </div>
      </div>

      {{--<div class="col-lg-6">
         <div id="chart"></div>
         {!! $lava->render('PieChart', 'USERS', 'chart') !!}
      </div>--}}
   </div>
</div>
@endsection
