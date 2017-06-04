@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
@if(Session::has('message'))
<div class="row" style="margin-top: -2rem; margin-left: -15rem; margin-right: -15rem;">
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
         <div class="panel panel-default" style="border-top: saddlebrown 3px solid;">
            <div class="panel-heading">
               <h4><i class="fa fa-users"></i>&nbsp;&nbsp;USERS</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">

            <div class="pull-right mb-10 hidden-sm hidden-xs">
               <a href="{{ route('admin_create_user') }}" class="btn btn-sm btn-success">Create User</a>
            </div>
            <div class="clearfix"></div>

            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <th>ID</th>
                     <th>Name</th>
                     <th>E-mail</th>
                     <th>Role</th>
                     <th>Date Added</th>
                     <th>Last Updated</th>
                     <th>Actions</th>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr>
                        <td><b>{{ $user->id }}</b></td>
                        <td><b>{{ $user->name }}</b></td>
                        <td><b>{{ $user->email }}</b></td>
                        <td><b>{{ ucfirst($user->role) }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($user->created_at)) }}</b></td>
                        <td><b>{{ date('m/d/Y', strtotime($user->updated_at)) }}</b></td>
                        <td>
                           <a href="{{ route('show_user_profile', $user->id) }}" class="btn btn-xs btn-primary" title="View User"><i class="fa fa-search"></i></a>
                           <a href="{{ route('show_user_profile', $user->id) }}" class="btn btn-xs btn-info" title="Edit User"><i class="fa fa-pencil"></i></a>
                           <a href="{{ route('show_user_profile', $user->id) }}" class="btn btn-xs btn-danger" title="Delete User"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
$(document).ready(function() {
   var count = 0;
   var checkCount = 0;
   var singularCount = 0;

   $("#select_all").change(function() {
      $(".users").prop('checked', $(this).prop("checked"));
      count = document.querySelectorAll('.users:checked').length;
      en_dis_delBtn(count);
   });

   $(".users").change(function() {
      singularCount = document.querySelectorAll('.users:checked').length;

      en_dis_delBtn(singularCount);
   });

   function en_dis_delBtn (checkCount) {
      if (checkCount == 0) {
         $("#delBtn").addClass('disabled');
      } else {
         $("#delBtn").removeClass('disabled');
      }
   }
});
</script>
@endsection
