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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   @include('layouts.admin-sidebar')
   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-cogs"></i>&nbsp;&nbsp;AFTERMARKET LIST</h4>
            </div>
         </div>
      </div>

      @if(Request::has('filter'))
      <div class="alert alert-success" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">Entered Query: "{{ Request::get('filter') }}" Filtered Result: {{ $aftermarkets->firstItem() }} to {{ $aftermarkets->lastItem() }} out of {{$aftermarkets->total()}} Aftermarket</div>
      @endif
      <form>
         <div class="form-group">
            <label for="SearchInput" class="control-label pull-left" style="line-height: 3rem;">Search:</label>
            <div class="col-lg-3" >
               <input id="SearchInput" type="search" class="form-control" name="filter" style="height: 30px;">
            </div>
            <button class="btn btn-sm btn-primary">Search</button>
            <a href="{{ route('admin_after_market_index') }}" class="btn btn-sm btn-warning">Clear Search</a>
            <div class="pull-right mb-10 hidden-sm hidden-xs">

               <a href="{{ route('create_after_market') }}" class="btn btn-success">&nbsp;Create Aftermarket</a>
            </div>
         </div>
      </form>
      <div class="clearfix"></div>

      @if(count($aftermarkets) != 0)
      <div class="row">
         <div class="col-lg-12">

            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Model</th>
                     <th>Serial Number</th>
                     <th>Tag Number</th>
                     <th>Drawing Number</th>
                     <th>Date Added</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($aftermarkets as $aftermarket)
                     <tr>
                        <td><b>{{ $aftermarket->id }}</b></td>
                        <td><b>{{ $aftermarket->name }}</b></td>
                        <td><b>{{ $aftermarket->model }}</b></td>
                        <td><b>{{ $aftermarket->serial_number }}</b></td>
                        <td><b>{{ $aftermarket->tag_number }}</b></td>
                        <td><b>{{ $aftermarket->drawing_number }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($aftermarket->created_at)) }}</b></td>
                        <td>
                           <a class="btn btn-xs btn-primary" href="{{ route('admin_after_market_show', $aftermarket->id) }}" title="View Aftermarket"><i class="fa fa-search"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {{ $aftermarkets->firstItem() }} to {{ $aftermarkets->lastItem() }} out of {{ $aftermarkets->total() }} Aftermarket(s)</label>
                  </div>
                  <div class="form-group right">
                     <span class="right">{!! $aftermarkets->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div>
               </form>
            </div>
         </div>
      </div>
      @else
      <div class="row">
         <div class="col-lg-12">
            <div class="alert search-error" role="alert" ><b>You have 0 records for Aftermarket.</b></div>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection
