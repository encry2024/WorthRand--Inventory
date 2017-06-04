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
   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;SALES ENGINEERS</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>E-mail</th>
                     <th>Account Status</th>
                     <th>Date Added</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr>
                        <td><b>{{ $user->id }}</b></td>

                        <td><b>{{ $user->name }}</b></td>
                        <td><b>{{ $user->email }}</b></td>
                        <td><b>{!! $user->is_active == 1 ? '<label class="label label-success">ACTIVE</label>' : '<label class="label label-danger">DEACTIVATED</label>' !!}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($user->created_at)) }}</b></td>
                        <td>
                           <a class="btn btn-xs btn-primary" id="viewBtn" href="{{ route('admin_show_sales_engineer', $user->id) }}" title="View User"><i class="fa fa-search"></i></a>
                           <a class="btn btn-xs btn-info" id="editBtn" href="{{ route('admin_edit_sales_engineer_information', $user->id) }}" title="Edit User"><i class="fa fa-pencil"></i></a>
                           @if($user->isActivate())
                           <a class="btn btn-xs btn-warning" id="deactivateBtn" onclick="deactivateFnc({{ $user->id }});" style="cursor: pointer;" title="Deactive Account" data-toggle="modal" data-target="#DeactivateModal"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                           @else
                           <a class="btn btn-xs btn-success" id="activateBtn" onclick="activateFnc({{ $user->id }});" style="cursor: pointer;" title="Active Account" data-toggle="modal" data-target="#ActivateModal"><i class="fa fa-fire" aria-hidden="true"></i></a>
                           @endif
                           <a class="btn btn-xs btn-danger" id="deleteBtn" onclick="deleteFnc({{ $user->id }});" style="cursor: pointer;" title="Delete User" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{ $users->links() }}
               <form class="form-inline">
                  <div class="form-group left" style=" margin-top: 2.55rem; ">
                     <label class="" for="">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} out of {{ $users->total() }} Sales Engineer(s)</label>
                  </div>
                  {{-- <div class="form-group right">
                     <span class="right">{!! $users->appends(['filter' => Request::get('filter')])->render() !!}</span>
                  </div> --}}
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="ActivateModal">
   <form method="POST" id="ActivateForm">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Activate Sales Engineer</h4>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to activate this Sales Engineer's Account?</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-warning">Activate</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </form>
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="DeactivateModal">
   <form method="POST" id="DeactivateForm">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Deactivate Sales Engineer</h4>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to deactivate this Sales Engineer's Account?</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-warning">Deactivate</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </form>
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="DeleteModal">
   <form method="POST" id="DeleteForm">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Delete Sales Engineer</h4>
            </div>
            <div class="modal-body">
               <p><code>Are you sure you want to delete this Sales Engineer?</code></p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </form>
</div><!-- /.modal -->

<script>
function deleteFnc(uId) {
   var deleteRoute = "{{ route('admin_delete_se', ':u_id') }}";
   deleteRoute = deleteRoute.replace(':u_id', uId);
   document.getElementById('DeleteForm').action = deleteRoute;
}

function activateFnc(uId) {
   var activateRoute = "{{ route('admin_activate_se', ':u_id') }}";
   activateRoute = activateRoute.replace(':u_id', uId);
   document.getElementById('ActivateForm').action = activateRoute;
}

function deactivateFnc(uId) {
   var deactivateRoute = "{{ route('admin_deactivate_se', ':u_id') }}";
   deactivateRoute = deactivateRoute.replace(':u_id', uId);
   document.getElementById('DeactivateForm').action = deactivateRoute;
}
</script>
@endsection
