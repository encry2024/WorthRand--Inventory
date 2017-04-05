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

   <div class="col-md-3">
      <div class="list-group">
         <a href="{{ route('admin_customer_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>


   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;ADD CUSTOMER</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <form class="form-horizontal" id="createCustomerForm" action="{{ route('post_create_customer') }}" method="POST">
               {{ csrf_field() }}

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="name" class="col-lg-3 col-md-5 control-label">Customer Name</label>
                     <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                        <span class="help-block">
                           <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class=" form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="address" class="col-lg-3 col-md-5 control-label">Address</label>
                     <div class="col-md-6">
                        <textarea id="address" class="form-control" name="address" required></textarea>

                        @if ($errors->has('address'))
                        <span class="help-block">
                           <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class=" form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="city" class="col-lg-3 col-md-5 control-label">City</label>
                     <div class="col-md-6">
                        <input id="city" type="text" class="form-control" name="city" required>

                        @if ($errors->has('city'))
                        <span class="help-block">
                           <strong>{{ $errors->first('city') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="postal_code" class=" col-lg-3 col-md-5 control-label">Postal Code</label>
                     <div class="col-md-6">
                        <input id="postal_code" type="text" class="form-control" name="postal_code" required>

                        @if ($errors->has('postal_code'))
                        <span class="help-block">
                           <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="contact_person" class=" col-lg-3 col-md-5 control-label">Contact Person</label>
                     <div class="col-md-6">
                        <input id="contact_person" type="text" class="form-control" name="contact_person" required>

                        @if ($errors->has('contact_person'))
                        <span class="help-block">
                           <strong>{{ $errors->first('contact_person') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('position_of_contact_person') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="position_of_contact_person" class=" col-lg-3 col-md-5 control-label">Position of Contact Person</label>
                     <div class="col-md-6">
                        <input id="position_of_contact_person" type="text" class="form-control" name="position_of_contact_person" required>

                        @if ($errors->has('position_of_contact_person'))
                        <span class="help-block">
                           <strong>{{ $errors->first('position_of_contact_person') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('plant_site_address') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="plant_site_address" class=" col-lg-3 col-md-5 control-label">Plant Site Address</label>
                     <div class="col-md-6">
                        <textarea id="plant_site_address" type="text" class="form-control" name="plant_site_address" required></textarea>

                        @if ($errors->has('plant_site_address'))
                        <span class="help-block">
                           <strong>{{ $errors->first('plant_site_address') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                  <div class="col-lg-pull-1">
                     <label for="contact_number" class=" col-lg-3 col-md-5 control-label">Contact Number</label>
                     <div class="col-md-6">
                        <input id="contact_number" type="text" class="form-control" name="contact_number" required>

                        @if ($errors->has('contact_number'))
                        <span class="help-block">
                           <strong>{{ $errors->first('contact_number') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>

               <br>
               <div class="col-lg-offset-3" style="margin-left: 26% !important;">
                  <a class="btn btn-success" href="#" onclick='document.getElementById("createCustomerForm").submit();'><i class="fa fa-check"></i>&nbsp; Add</a>
                  <button class="btn btn-danger clear_input"><i class="fa fa-times"></i>&nbsp; Clear</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script>
$(".clear_input").click(function(e) {
   e.preventDefault();
   $(":input[type='text']").each(function() {
      this.value = "";
   })
});
</script>
@endsection
