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
               <h4><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;CUSTOMERS</h4>
            </div>
         </div>
      </div>

      @if(Request::has('filter'))
      <div class="alert alert-success" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">Entered Query: "{{ Request::get('filter') }}" Filtered Result: {{ $customers->firstItem() }} to {{ $customers->lastItem() }} out of {{$customers->total()}} Customers</div>
      @endif
      <form>
         <div class="form-group">
            <label for="SearchInput" class="control-label pull-left" style="line-height: 3rem;">Search:</label>
            <div class="col-lg-3" >
               <input id="SearchInput" type="search" class="form-control" name="filter" style="height: 30px;">
            </div>
            <button class="btn btn-sm btn-primary">Search</button>
            <a href="{{ route('admin_customer_index') }}" class="btn btn-sm btn-warning">Clear Search</a>
            <div class="pull-right mb-10 hidden-sm hidden-xs">

               <a class="btn btn-sm btn-success" href="{{ route('admin_customer_create') }}">Create Customer</a>
            </div>
         </div>
      </form>

      @if(count($customers) != 0)
      <div class="row">
         <div class="col-lg-12">



            <div class="table-reponsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Address</th>
                     <th>City</th>
                     <th>Postal Code</th>
                     <th>Date Added</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($customers as $customer)
                     <tr>
                        <td><b>{{ ((($customers->currentPage() - 1) * $customers->perPage()) + ($ctr++) + 1) }}</b></td>
                        <td><b>{{ $customer->name }}</b></td>
                        <td><b>{{ $customer->address }}</b></td>
                        <td><b>{{ $customer->city }}</b></td>
                        <td><b>{{ $customer->postal_code }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($customer->created_at)) }}</b></td>
                        <td>
                           <a href="{{ route('admin_show_customer', $customer->id) }}" class="btn btn-primary btn-xs" title="View Customer"><i class="fa fa-search"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               @if (Request::has('filter'))
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {{ count($customers) == 0 ? count($customers) . ' to '.  $customers->lastItem() . ' out of ' . $customers->total() : $customers->firstItem() . ' to ' . $customers->lastItem() . ' out of ' . $customers->total() . ' Customers'}}</label>
                  </div>
                  <div class="form-group right">
                     <span class="right">{!! $customers->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div>
               </form>
               @else
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {!! $customers->firstItem() !!} to {!! $customers->lastItem() !!} out of {!! $customers->total() !!} Customers</label>
                  </div>
                  <div class="form-group right">
                     <span class="right">{!! $customers->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div>
               </form>
               @endif
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

<script type="text/javascript">
$('.chosen-select').chosen();
</script>
@endsection
