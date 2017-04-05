@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="container-fluid">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="row">
         @include('layouts.admin-sidebar')
         <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">

            <div class="row">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     INDENTED PROPOSALS
                  </div>
               </div>
            </div>

            @if(count($indented_proposals) != 0)
            <div class="row">
               <div class="col-lg-12">
                  <div class="col-lg-12">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <th>ID</th>
                              <th>Purchase Order</th>
                              <th>Sold To</th>
                              <th>Status</th>
                              <th>Submitted by:</th>
                              <th class="text-right">Actions</th>
                           </thead>
                           <tbody>
                              @foreach($indented_proposals as $indented_proposal)
                              <tr class="{{ $indented_proposal->collection_status == "PENDING" ? "bg-warning" : "bg-success" }}">
                                 <td>{{ $indented_proposal->id }}</td>
                                 <td>@if($indented_proposal->purchase_order == '')
                                    <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                    @else
                                    {{ $indented_proposal->purchase_order }}
                                    @endif</td>
                                    <td>
                                       @if($indented_proposal->customer_id == 0)
                                       <span class='label label-danger'>Not Provided / Draft Proposal</span>
                                       @else
                                       {{ $indented_proposal->customer->name }}
                                       @endif
                                    </td>
                                    <td>{{ $indented_proposal->collection_status }}</td>
                                    <td>{{ $indented_proposal->user->name }}</td>
                                    <td class="text-right">
                                       <a href="{{ route('admin_show_pending_proposal', $indented_proposal->id) }}" class="btn btn-sm btn-primary">View Proposal</a>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               @else
               <div class="row">
                  <div class="col-lg-12">
                     <div class="alert alert-danger" role="alert" style="background-color: #d9534f; border-color: #b52b27; color: white;">You Have 0 Pending Proposal for Indented Proposal.</div>
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
   @endsection
