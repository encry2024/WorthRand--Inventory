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
               <h4><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;SEALS</h4>
            </div>
         </div>
      </div>

      <div class="pull-right mb-10 hidden-sm hidden-xs">
         <a href="{{ route('create_after_market') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Create Seal</a>
      </div>
      <div class="clearfix"></div>

      @if(count($seals) != 0)
      <div class="row">
         <div class="col-lg-12">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Size</th>
                     <th>Seal Type</th>
                     <th>Model</th>
                     <th>Material Number</th>
                     <th>Date Added</th>
                     <th>Actions</th>
                  </thead>

                  <tbody>
                     @foreach($seals as $seal)
                     <tr>
                        <td><b>{{ ((($seals->currentPage() - 1) * $seals->perPage()) + ($ctr++) + 1) }}</b></td>
                        <td><b>{{ $seal->name }}</b></td>
                        <td><b>{{ $seal->size }}</b></td>
                        <td><b>{{ $seal->seal_type }}</b></td>
                        <td><b>{{ $seal->model }}</b></td>
                        <td><b>{{ $seal->material_number }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($seal->created_at)) }}</b></td>
                        <td>
                           <a class="btn btn-xs btn-primary" href="{{ route('se_show_seal', $seal->id) }}" title="View {{ $seal->name }}"><i class="fa fa-search"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{ $seals->links() }}
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {{ $seals->firstItem() }} to {{ $seals->lastItem() }} out of {{ $seals->total() }} Seal(s)</label>
                  </div>
                  {{-- <div class="form-group right">
                     <span class="right">{!! $seals->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div> --}}
               </form>
            </div>
         </div>
      </div>
      @else
      <div class="row">
         <div class="col-lg-12">
            <div class="alert search-error" role="alert" ><b>You have 0 records for Seals.</b></div>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection
