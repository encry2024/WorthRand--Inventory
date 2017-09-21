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
@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="col-md-3">
      <div class="list-group">
         <a href="{{ route('admin_seal_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;ADD SEAL</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">

         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <form class="form-horizontal" id="createAfterMarketForm" action="{{ route('admin_post_seal_create') }}" method="POST">
               {{ csrf_field() }}

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-3 control-label">Name:</label>

                  <div class="col-md-6">
                     <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                     @if ($errors->has('name'))
                     <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                  <label for="drawing_number" class="col-md-3 control-label">Drawing Number:</label>

                  <div class="col-md-6">
                     <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ old('drawing_number') }}" required autofocus>

                     @if ($errors->has('drawing_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('drawing_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('bom_number') ? ' has-error' : '' }}">
                  <label for="bom_number" class="col-md-3 control-label">B.O.M Number:</label>

                  <div class="col-md-6">
                     <input id="bom_number" type="text" class="form-control" name="bom_number" value="{{ old('bom_number') }}" required autofocus>

                     @if ($errors->has('bom_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('bom_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('end_user') ? ' has-error' : '' }}">
                  <label for="end_user" class="col-md-3 control-label">End User:</label>

                  <div class="col-md-6">
                     <input id="end_user" type="text" class="form-control" name="end_user" value="{{ old('end_user') }}" required autofocus>

                     @if ($errors->has('end_user'))
                     <span class="help-block">
                        <strong>{{ $errors->first('end_user') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('seal_type') ? ' has-error' : '' }}">
                  <label for="seal_type" class="col-md-3 control-label">Seal Type:</label>

                  <div class="col-md-6">
                     <input id="seal_type" type="text" class="form-control" name="seal_type" value="{{ old('seal_type') }}" required autofocus>

                     @if ($errors->has('seal_type'))
                     <span class="help-block">
                        <strong>{{ $errors->first('seal_type') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                  <label for="size" class="col-md-3 control-label">Size:</label>

                  <div class="col-md-6">
                     <input id="size" type="text" class="form-control" name="size" value="{{ old('size') }}" required autofocus>

                     @if ($errors->has('size'))
                     <span class="help-block">
                        <strong>{{ $errors->first('size') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                  <label for="material_number" class="col-md-3 control-label">Material Number:</label>

                  <div class="col-md-6">
                     <input id="material_number" type="text" class="form-control" name="material_number" value="{{ old('material_number') }}" required autofocus>

                     @if ($errors->has('material_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('material_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                  <label for="code" class="col-md-3 control-label">Code:</label>

                  <div class="col-md-6">
                     <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

                     @if ($errors->has('code'))
                     <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                  <label for="model" class="col-md-3 control-label">Model:</label>

                  <div class="col-md-6">
                     <input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}" required autofocus>

                     @if ($errors->has('model'))
                     <span class="help-block">
                        <strong>{{ $errors->first('model') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                  <label for="serial_number" class="col-md-3 control-label">Serial Number:</label>

                  <div class="col-md-6">
                     <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ old('serial_number') }}" required autofocus>

                     @if ($errors->has('serial_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('serial_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group {{ $errors->has('tag') ? ' has-error' : '' }}">
                  <label for="tag" class="col-md-3 control-label">Tag:</label>

                  <div class="col-md-6">
                     <input id="tag" type="text" class="form-control" name="tag" value="{{ old('tag') }}" required autofocus>

                     @if ($errors->has('tag'))
                     <span class="help-block">
                        <strong>{{ $errors->first('tag') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                  <label for="price" class="col-md-3 control-label">Price:</label>

                  <div class="col-md-6">
                     <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>
                     </div>
                     @if ($errors->has('price'))
                     <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div style="margin-left: 25.5%;">
                  <a class="btn btn-success" href="#" onclick='document.getElementById("createAfterMarketForm").submit();'><i class="fa fa-check"></i>&nbsp; Create Seal</a>
                  <button class="btn btn-danger clear_input"><span class="glyphicon glyphicon-remove"></span> Clear</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script>
$(document).ready(function (){
   $("#price").on("focusout", function(e) {
      e.preventDefault();
      var sealPrice = document.getElementById("price").value
      string = numeral(sealPrice).format('0,0.00');

      document.getElementById("price").value = string;
   });


   $(".clear_input").click(function(e) {
      e.preventDefault();
      $(":input[type='text']").each(function() {
         this.value = "";
      })
   });
});
</script>
@endsection
