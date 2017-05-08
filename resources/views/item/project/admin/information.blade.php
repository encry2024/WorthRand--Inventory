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
         <a href="{{ route('admin_project_show', $project->id) }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;EDIT {{ strtoupper($project->name) }}</h4>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <form class="form-horizontal" id="createProjectForm" action="{{ route('admin_project_information_update', $project->id) }}" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               {{ method_field('PATCH') }}
               <input type="hidden" name="project_id" value="{{ $project->id }}">

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Name:</label>

                  <div class="col-md-6">
                     <input id="name" type="text" class="form-control" name="name" value="{{ $project->name }}" required autofocus>

                     @if ($errors->has('name'))
                     <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                  <label for="model" class="col-md-4 control-label">Model:</label>

                  <div class="col-md-6">
                     <input id="model" type="text" class="form-control" name="model" value="{{ $project->model }}" required autofocus>

                     @if ($errors->has('model'))
                     <span class="help-block">
                        <strong>{{ $errors->first('model') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('ccn_number') ? ' has-error' : '' }}">
                  <label for="ccn_number" class="col-md-4 control-label">CCN Number:</label>

                  <div class="col-md-6">
                     <input id="ccn_number" type="text" class="form-control" name="ccn_number" value="{{ $project->ccn_number }}" required autofocus>

                     @if ($errors->has('ccn_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('ccn_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('part_number') ? ' has-error' : '' }}">
                  <label for="part_number" class="col-md-4 control-label">Part Number:</label>

                  <div class="col-md-6">
                     <input id="part_number" type="text" class="form-control" name="part_number" value="{{ $project->part_number }}" required autofocus>

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
                     <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ $project->reference_number }}" required autofocus>

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
                     <input id="material_number" type="text" class="form-control" name="material_number" value="{{ $project->material_number }}" required autofocus>

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
                     <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{ $project->serial_number }}" required autofocus>

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
                     <input id="tag_number" type="text" class="form-control" name="tag_number" value="{{ $project->tag_number }}" required autofocus>

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
                     <input id="drawing_number" type="text" class="form-control" name="drawing_number" value="{{ $project->drawing_number }}" required autofocus>

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
                     <input id="contact_person" type="text" class="form-control" name="contact_person" value="{{ $project->contact_person }}" required autofocus>

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
                     <input id="address" type="text" class="form-control" name="address" value="{{ $project->address }}" required autofocus>

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
                     <input id="consultant" type="text" class="form-control" name="consultant" value="{{ $project->consultant }}" required autofocus>

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
                     <input id="epc" type="text" class="form-control" name="epc" value="{{ $project->epc }}" required autofocus>

                     @if ($errors->has('epc'))
                     <span class="help-block">
                        <strong>{{ $errors->first('epc') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('epc_award') ? ' has-error' : '' }}">
                  <label for="epc_award" class="col-md-4 control-label">EPC Award:</label>

                  <div class="col-md-6">
                     <input id="epc_award" type="text" class="form-control" name="epc_award" value="{{ $project->epc_award }}" required autofocus>

                     @if ($errors->has('epc_award'))
                     <span class="help-block">
                        <strong>{{ $errors->first('epc_award') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('vendors') ? ' has-error' : '' }}">
                  <label for="vendors" class="col-md-4 control-label">Vendors:</label>

                  <div class="col-md-6">
                     <input id="vendors" type="text" class="form-control" name="vendors" value="{{ $project->vendors }}" required autofocus>

                     @if ($errors->has('vendors'))
                     <span class="help-block">
                        <strong>{{ $errors->first('vendors') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('implementation_date') ? ' has-error' : '' }}">
                  <label for="implementation_date" class="col-md-4 control-label">Implementation Date:</label>

                  <div class="col-md-6">
                     <input id="implementation_date" type="text" class="form-control" name="implementation_date" value="{{ $project->implementation_date }}" required autofocus>

                     @if ($errors->has('implementation_date'))
                     <span class="help-block">
                        <strong>{{ $errors->first('implementation_date') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('bu') ? ' has-error' : '' }}">
                  <label for="bu" class="col-md-4 control-label">BU:</label>

                  <div class="col-md-6">
                     <input id="bu" type="text" class="form-control" name="bu" value="{{ $project->bu }}" required autofocus>

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
                     <input id="status" type="text" class="form-control" name="status" value="{{ $project->status }}" required autofocus>

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
                     <input id="final_result" type="text" class="form-control" name="final_result" value="{{ $project->final_result }}" required autofocus>

                     @if ($errors->has('Final Result'))
                     <span class="help-block">
                        <strong>{{ $errors->first('Final Result') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                  <label for="value" class="col-md-4 control-label">Value:</label>

                  <div class="col-md-6">
                     <input id="value" type="text" class="form-control" name="value" value="{{ $project->value }}" required autofocus>

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

               <div style="margin-left: 27.5rem;">
                  <button class="btn btn-success" onclick='document.getElementById("createProjectForm").submit();'><i class="fa fa-edit"></i>&nbsp;Update</button>
                  <button class="btn btn-danger clear_input"><i class="fa fa-remove"></i> Clear</button>
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
