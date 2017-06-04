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
               <h4><i class="fa fa-cog"></i>&nbsp;&nbsp;PROJECTS</h4>
            </div>
         </div>
      </div>

      <div class="pull-right mb-10 hidden-sm hidden-xs">
         <a href="{{ route('create_project') }}" class="btn btn-sm btn-success">Create Project</a>
      </div>
      <div class="clearfix"></div>

      @if(count($projects) != 0)
      <div class="row">
         <div class="col-lg-12">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Material Number</th>
                     <th>Serial Number</th>
                     <th>Tag Number</th>
                     <th>Drawing Number</th>
                     <th>Date Added</th>
                     <th>Last Updated</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($projects as $project)
                     <tr>
                        <td><b>{{ $project->id }}</b></td>
                        <td><b>{{ $project->name }}</b></td>
                        <td><b>{{ $project->material_number }}</b></td>
                        <td><b>{{ $project->serial_number }}</b></td>
                        <td><b>{{ $project->tag_number }}</b></td>
                        <td><b>{{ $project->drawing_number }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($project->created_at)) }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($project->updated_at)) }}</b></td>
                        <td>
                           <a class="btn btn-xs btn-primary" href="{{ route('admin_project_show', $project->id) }}" title="View Project"><i class="fa fa-search"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{ $projects->links() }}
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} out of {{ $projects->total() }} Project(s)</label>
                  </div>
                  {{-- <div class="form-group right">
                     <span class="right">{!! $projects->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div> --}}
               </form>
            </div>
         </div>
      </div>
      @else
      <div class="row">
         <div class="col-lg-12">
            <div class="alert search-error" role="alert"><b>You have 0 records for Projects.</b></div>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection
