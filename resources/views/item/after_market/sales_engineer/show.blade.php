@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="row">

      <div class="col-md-3">
         <div class="list-group">
            <a href="{{ route('aftermarket_index') }}" class="list-group-item" style="font-size: 13px;">
               <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
            </a>
         </div>
      </div>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
         <div class="row">
            <div class="panel panel-default">
               <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                  <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($afterMarket->name) }}</h4>
               </div>
            </div>
         </div>

         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><b>Information</b></a></li>
            <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><b>Pricing History</b></a></li>
         </ul>

         <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="information">
               <br>
               <div class="row">
                  <div class="col-lg-12">
                     <form class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <label for="name" class="col-md-4 control-label">Name:</label>

                           <div class="col-md-6">
                              <label id="name" class="control-label" name="name">{{ $afterMarket->name }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                           <label for="model" class="col-md-4 control-label">Model:</label>

                           <div class="col-md-6">
                              <label id="model" class="control-label">{{ $afterMarket->model }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('ccn_number') ? ' has-error' : '' }}">
                           <label for="ccn_number" class="col-md-4 control-label">CCN Number:</label>

                           <div class="col-md-6">
                              <label id="ccn_number" class="control-label">{{ $afterMarket->ccn_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('part_number') ? ' has-error' : '' }}">
                           <label for="part_number" class="col-md-4 control-label">Part Number:</label>

                           <div class="col-md-6">
                              <label id="part_number" class="control-label">{{ $afterMarket->part_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                           <label for="reference_number" class="col-md-4 control-label">Reference Number:</label>

                           <div class="col-md-6">
                              <label id="reference_number" class="control-label">{{ $afterMarket->reference_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                           <label for="material_number" class="col-md-4 control-label">Material Number:</label>

                           <div class="col-md-6">
                              <label id="material_number" class="control-label"> {{ $afterMarket->material_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                           <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                           <div class="col-md-6">
                              <label id="serial_number" class="control-label">{{ $afterMarket->serial_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('tag_number') ? ' has-error' : '' }}">
                           <label for="tag_number" class="col-md-4 control-label">Tag Number:</label>

                           <div class="col-md-6">
                              <label id="tag_number" class="control-label">{{ $afterMarket->tag_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                           <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                           <div class="col-md-6">
                              <label id="drawing_number" class="control-label">{{ $afterMarket->drawing_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('stock_number') ? ' has-error' : '' }}">
                           <label for="stock_number" class="col-md-4 control-label">Stock Number:</label>

                           <div class="col-md-6">
                              <label id="stock_number" class="control-label">{{ $afterMarket->stock_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('sap_number') ? ' has-error' : '' }}">
                           <label for="sap_number" class="col-md-4 control-label">SAP Number:</label>

                           <div class="col-md-6">
                              <label id="sap_number" class="control-label">{{ $afterMarket->sap_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                           <label for="description" class="col-md-4 control-label">Description:</label>

                           <div class="col-md-6">
                              <label id="description" class="control-label">{{ $afterMarket->description }}</label>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="pricing_history">
               <br>
               <div class="row">
                  <div class="col-lg-12">
                     @if(count($afterMarket->after_market_pricing_history) != 0)
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                           <thead>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Created</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">P.O Number</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Year</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Price ($)</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Terms</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Delivery</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">FPD Reference</th>
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">WPC Reference</th>
                           </thead>

                           <tbody>
                              @foreach($afterMarket->after_market_pricing_history as $pricing_history)
                              <tr>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($pricing_history->created_at)) }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->po_number }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->pricing_date }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ number_format($pricing_history->price, 2) }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->terms }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->delivery }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->fpd_reference }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->wpc_reference }}</b></td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     @else
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="alert search-error" role="alert"><b>You have 0 records for {{ $afterMarket->name }}'s Pricing History.</b></div>
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
