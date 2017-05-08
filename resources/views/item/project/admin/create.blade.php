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
         <a href="{{ route('admin_project_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;ADD PROJECT</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <form class="form-horizontal" id="createProjectForm" action="{{ route('post_project') }}" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Name:</label>

                  <div class="col-md-6">
                     <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                     @if ($errors->has('name'))
                     <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('ccn_number') ? ' has-error' : '' }}">
                  <label for="ccn_number" class="col-md-4 control-label">CCN Number:</label>

                  <div class="col-md-6">
                     <input id="ccn_number" type="text" class="form-control" name="ccn_number" value="{{ old('ccn_number') }}" required autofocus>

                     @if ($errors->has('ccn_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('ccn_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                  <label for="model" class="col-md-4 control-label">Model:</label>

                  <div class="col-md-6">
                     <input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}" required autofocus>

                     @if ($errors->has('model'))
                     <span class="help-block">
                        <strong>{{ $errors->first('model') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('part_number') ? ' has-error' : '' }}">
                  <label for="part_number" class="col-md-4 control-label">Part Number:</label>

                  <div class="col-md-6">
                     <input id="part_number" type="text" class="form-control" name="part_number" value="{{ old('part_number') }}" required autofocus>

                     @if ($errors->has('part_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('part_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                  <label for="reference_number" class="col-md-4 control-label">Reference Number:</label>

                  <div class="col-md-6">
                     <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ old('reference_number') }}" required autofocus>

                     @if ($errors->has('reference_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('reference_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                  <label for="material_number" class="col-md-4 control-label">Material Number:</label>

                  <div class="col-md-6">
                     <input id="material_number" type="text" class="form-control" name="material_number" value="{{ old('material_number') }}" required autofocus>

                     @if ($errors->has('material_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('material_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                  <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                  <div class="col-md-6">
                     <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ old('serial_number') }}" required autofocus>

                     @if ($errors->has('serial_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('serial_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('tag_number') ? ' has-error' : '' }}">
                  <label for="tag_number" class="col-md-4 control-label">Tag Number:</label>

                  <div class="col-md-6">
                     <input id="tag_number" type="text" class="form-control" name="tag_number" value="{{ old('tag_number') }}" required autofocus>

                     @if ($errors->has('tag_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('tag_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                  <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                  <div class="col-md-6">
                     <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ old('drawing_number') }}" required autofocus>

                     @if ($errors->has('drawing_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('drawing_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                  <label for="contact_person" class="col-md-4 control-label">Contact Person:</label>

                  <div class="col-md-6">
                     <input id="contact_person" type="text" class="form-control" name="contact_person" value="{{ old('contact_person') }}" required autofocus>

                     @if ($errors->has('contact_person'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_person') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address" class="col-md-4 control-label">Address:</label>

                  <div class="col-md-6">
                     <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                     @if ($errors->has('address'))
                     <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('consultant') ? ' has-error' : '' }}">
                  <label for="consultant" class="col-md-4 control-label">Consultant:</label>

                  <div class="col-md-6">
                     <input id="consultant" type="text" class="form-control" name="consultant" value="{{ old('consultant') }}" required autofocus>

                     @if ($errors->has('consultant'))
                     <span class="help-block">
                        <strong>{{ $errors->first('consultant') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('epc') ? ' has-error' : '' }}">
                  <label for="epc" class="col-md-4 control-label">EPC:</label>

                  <div class="col-md-6">
                     <input id="epc" type="text" class="form-control" name="epc" value="{{ old('epc') }}" required autofocus>

                     @if ($errors->has('epc'))
                     <span class="help-block">
                        <strong>{{ $errors->first('epc') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('vendors') ? ' has-error' : '' }}">
                  <label for="vendors" class="col-md-4 control-label">Vendor:</label>

                  <div class="col-md-6">
                     <input id="vendors" type="text" class="form-control" name="vendors" value="{{ old('vendors') }}" required autofocus>

                     @if ($errors->has('vendors'))
                     <span class="help-block">
                        <strong>{{ $errors->first('vendors') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('epc_award') ? ' has-error' : '' }}">
                  <label for="epc_award" class="col-md-4 control-label">EPC Award:</label>

                  <div class="col-md-6">
                     <input id="epc_award" type="text" class="form-control" name="epc_award" value="{{ old('epc_award') }}" required autofocus>

                     @if ($errors->has('epc_award'))
                     <span class="help-block">
                        <strong>{{ $errors->first('epc_award') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('implementation_date') ? ' has-error' : '' }}">
                  <label for="implementation_date" class="col-md-4 control-label">Implementation Date:</label>

                  <div class="col-md-6">
                     <div class="input-group date">
                       <input id="implementation_date" type="text" class="form-control" name="implementation_date" value="{{ old('implementation_date') }}" required autofocus>
                       <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                     </div>
                     @if ($errors->has('implementation_date'))
                     <span class="help-block">
                        <strong>{{ $errors->first('implementation_date') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('bu') ? ' has-error' : '' }}">
                  <label for="bu" class="col-md-4 control-label">B.U:</label>

                  <div class="col-md-6">
                     <input id="bu" type="text" class="form-control" name="bu" value="{{ old('bu') }}" required autofocus>

                     @if ($errors->has('bu'))
                     <span class="help-block">
                        <strong>{{ $errors->first('bu') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <label for="status" class="col-md-4 control-label">Status:</label>

                  <div class="col-md-6">
                     <input id="status" type="text" class="form-control" name="status" value="{{ old('status') }}" required autofocus>

                     @if ($errors->has('status'))
                     <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('final_result') ? ' has-error' : '' }}">
                  <label for="final_result" class="col-md-4 control-label">Final Result:</label>

                  <div class="col-md-6">
                     <input id="final_result" type="text" class="form-control" name="final_result" value="{{ old('final_result') }}" required autofocus>

                     @if ($errors->has('final_result'))
                     <span class="help-block">
                        <strong>{{ $errors->first('final_result') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                  <label for="value" class="col-md-4 control-label">Value:</label>

                  <div class="col-md-6">
                     <input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" required autofocus>

                     @if ($errors->has('value'))
                     <span class="help-block">
                        <strong>{{ $errors->first('value') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('scanned_file') ? ' has-error' : '' }}">
                  <label for="scanned_file" class="col-md-4 control-label">Scanned Project:</label>

                  <div class="col-md-6">
                     <input id="scanned_file" type="file" class="form-control" name="scanned_file" value="{{ old('scanned_file') }}" required autofocus>

                     @if ($errors->has('scanned_file'))
                     <span class="help-block">
                        <strong>{{ $errors->first('scanned_file') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-lg-10">
                     <div class="col-lg-offset-5">
                        <a class="btn btn-success" onclick='document.getElementById("createProjectForm").submit();' style="cursor: pointer;"><i class="fa fa-check"></i>&nbsp; Save</a>
                        <button class="btn btn-danger clear_input"><i class="fa fa-times"></i>&nbsp; Clear</button>
                     </div>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>

<script>
$('#project_dropdown').autocomplete({
   serviceUrl: '/autocomplete/countries',
   onSelect: function (suggestion) {
      alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
   }
});

$(".clear_input").click(function(e) {
   e.preventDefault();
   $(":input[type='text']").each(function() {
      this.value = "";
   })
});
</script>
@endsection
