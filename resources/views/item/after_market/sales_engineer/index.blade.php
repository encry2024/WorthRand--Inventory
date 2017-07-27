@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   @include('layouts.se-sidebar')
   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;AFTERMARKETS</h4>
            </div>
         </div>
      </div>

      @if(count($aftermarkets) != 0)
      <div class="row">
         <div class="col-lg-12">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>#</th>
                     <th>Name</th>
                     <th>Model</th>
                     <th>Material Number</th>
                     <th>Tag Number</th>
                     <th>Drawing Number</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($aftermarkets as $aftermarket)
                     <tr>
                        <td><b>{{ $aftermarket->id }}</b></td>
                        <td><b>{{ $aftermarket->name }}</b></td>
                        <td><b>{{ $aftermarket->model }}</b></td>
                        <td><b>{{ $aftermarket->material_number }}</b></td>
                        <td><b>{{ $aftermarket->tag_number }}</b></td>
                        <td><b>{{ $aftermarket->drawing_number }}</b></td>
                        <td>
                           <a href="{{ route('se_aftermarket_show', $aftermarket->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      @else
      <div class="row">
         <div class="col-lg-12">
            <div class="alert search-error" role="alert"><b>There are no currently available Aftermarkets</b></div>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection
