@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="container-fluid">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="row">
         <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
            <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
               <li class="nav-item"><a class="nav-link" href="{{ route('se_aftermarket_show', $afterMarket->id) }}"><i class="fa fa-cog"></i>&nbsp; {{ $afterMarket->name }}</a></li>

               <li>
                  <li class="nav-item"><a class="nav-link"  href="#"><i class="fa fa-th-list"></i>&nbsp; Pricing History</a>
                     <ul class="sub">
                        <li><a href="{{ route('se_aftermarket_pricing_history_index', $afterMarket->id) }}"><i class="fa fa-th-list"></i>&nbsp;Pricing History List</a></li>
                     </ul>
                  </li>
               </li>


               <li class="nav-item"><a class="nav-link"  href="{{ route('aftermarket_index') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
            </ul>
         </div>

         <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
            <div class="panel panel-default">
               <div class="panel-heading">
                  {{ strtoupper($afterMarket->name) }} PRICING HISTORY
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="col-lg-12">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <th>#</th>
                              <th>P.O Number</th>
                              <th>Year</th>
                              <th>Price</th>
                              <th>Terms</th>
                              <th>Delivery</th>
                              <th>FPD Reference</th>
                              <th>WPC Reference</th>
                           </thead>

                           <tbody>
                              @foreach($afterMarket->after_market_pricing_history as $pricing_history)
                              <tr>
                                 <td></td>
                                 <td>{{ $pricing_history->po_number }}</td>
                                 <td>{{ $pricing_history->pricing_date }}</td>
                                 <td>{{ $pricing_history->price }}</td>
                                 <td>{{ $pricing_history->terms }}</td>
                                 <td>{{ $pricing_history->delivery }}</td>
                                 <td>{{ $pricing_history->fpd_reference }}</td>
                                 <td>{{ $pricing_history->wpc_reference }}</td>
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
   </div>
</div>
@endsection
