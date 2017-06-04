@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="row" style="margin-top: -2rem;">
   <div class="alert alert-success alert-dismissible" role="alert"  style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
      <div class="container">
         <i style="margin-left: 18rem;" class="fa fa-check"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
         <button type="button" class="close" style="margin-right: 15rem;" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
   </div>
</div>
@endif

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="col-md-3">
      <div class="list-group">
         <button onclick="document.getElementById('UpdateSalesEngineerForm').submit();" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Update
         </button>
         <a href="{{ route('admin_sales_engineer_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;EDIT SALES ENGINEER</h4>
            </div>
         </div>
      </div>

      <form class="form-horizontal" action="{{ route('admin_update_sales_engineer', $sales_engineer->id) }}" method="POST" id="UpdateSalesEngineerForm">
         {{ csrf_field() }}
         <input type="hidden" name="user_id" value="{{ $sales_engineer->id }}">

         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name:</label>

            <div class="col-md-6">
               <input id="name" type="text" class="form-control" name="name" value="{{ $sales_engineer->name }}" autofocus>

               @if ($errors->has('name'))
               <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
               </span>
               @endif
            </div>
         </div>

         <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address:</label>

            <div class="col-md-6">
               <input id="email" type="email" class="form-control" name="email" value="{{ $sales_engineer->email }}" autofocus>

               @if ($errors->has('email'))
               <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
               </span>
               @endif
            </div>
         </div>

         <div class="form-group{{ $errors->has('target_sale') ? ' has-error' : '' }}">
            <label for="target_sale" class="col-md-4 control-label">Set Target Sale:</label>

            <div class="col-md-6">
               <input id="target_sale" type="text" class="form-control" name="target_sale" value="{{ count($sales_engineer->target_revenue) == 0 ? '0.00' : $sales_engineer->target_revenue->target_sale }}" autofocus>

               @if ($errors->has('target_sale'))
               <span class="help-block">
                  <strong>{{ $errors->first('target_sale') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </form>

   </div>
</div>
@stop
