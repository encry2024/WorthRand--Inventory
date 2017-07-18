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

               <div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
                  <label for="customer_id" class="col-md-4 control-label">Customer Name:</label>

                  <div class="col-md-6">
                     <select data-placeholder="Choose a Customer..." id="customerDropdown" name="customer_id" class="form-control chosen-select">
                        <option value=""></option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                     </select>

                     @if ($errors->has('customer_id'))
                     <span class="help-block">
                        <strong>{{ $errors->first('customer_id') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Project Name:</label>

                  <div class="col-md-6">
                     <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                     @if ($errors->has('name'))
                     <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('project_terms') ? ' has-error' : '' }}">
                  <label for="project_terms" class="col-md-4 control-label">Project Terms:</label>

                  <div class="col-md-6">
                     <input id="project_terms" type="text" class="form-control" name="project_terms" value="{{ old('project_terms') }}" required autofocus>

                     @if ($errors->has('project_terms'))
                     <span class="help-block">
                        <strong>{{ $errors->first('project_terms') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                  <label for="source" class="col-md-4 control-label">Source:</label>

                  <div class="col-md-6">
                     <input id="source" type="text" class="form-control" name="source" value="{{ old('source') }}" required autofocus>

                     @if ($errors->has('source'))
                     <span class="help-block">
                        <strong>{{ $errors->first('source') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                  <label for="address_1" class="col-md-4 control-label">Address:</label>

                  <div class="col-md-6">
                     <input id="address_1" type="text" class="form-control" name="address_1" value="{{ old('address_1') }}" required autofocus>

                     @if ($errors->has('address_1'))
                     <span class="help-block">
                        <strong>{{ $errors->first('address_1') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_person_1') ? ' has-error' : '' }}">
                  <label for="contact_person_1" class="col-md-4 control-label">Contact Person:</label>

                  <div class="col-md-6">
                     <input id="contact_person_1" type="text" class="form-control" name="contact_person_1" value="{{ old('contact_person_1') }}" required autofocus>

                     @if ($errors->has('contact_person_1'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_person_1') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_number_1') ? ' has-error' : '' }}">
                  <label for="contact_number_1" class="col-md-4 control-label">Contact Number:</label>

                  <div class="col-md-6">
                     <input id="contact_number_1" type="text" class="form-control" name="contact_number_1" value="{{ old('contact_number_1') }}" required autofocus>

                     @if ($errors->has('contact_number_1'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_number_1') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('email_1') ? ' has-error' : '' }}">
                  <label for="email_1" class="col-md-4 control-label">E-mail:</label>

                  <div class="col-md-6">
                     <input id="email_1" type="email_1" class="form-control" name="email_1" value="{{ old('email_1') }}" required autofocus>

                     @if ($errors->has('email_1'))
                     <span class="help-block">
                        <strong>{{ $errors->first('email_1') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('consultant') ? ' has-error' : '' }}">
                  <label for="consultant" class="col-md-4 control-label"><b>Consultant</b>:</label>

                  <div class="col-md-6">
                     <input id="consultant" type="text" class="form-control" name="consultant" value="{{ old('consultant') }}" required autofocus>

                     @if ($errors->has('consultant'))
                     <span class="help-block">
                        <strong>{{ $errors->first('consultant') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                  <label for="address_2" class="col-md-4 control-label">Address:</label>

                  <div class="col-md-6">
                     <input id="address_2" type="text" class="form-control" name="address_2" value="{{ old('address_2') }}" required autofocus>

                     @if ($errors->has('address_2'))
                     <span class="help-block">
                        <strong>{{ $errors->first('address_2') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_person_2') ? ' has-error' : '' }}">
                  <label for="contact_person_2" class="col-md-4 control-label">Contact Person:</label>

                  <div class="col-md-6">
                     <input id="contact_person_2" type="text" class="form-control" name="contact_person_2" value="{{ old('contact_person_2') }}" required autofocus>

                     @if ($errors->has('contact_person_2'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_person_2') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_number_2') ? ' has-error' : '' }}">
                  <label for="contact_number_2" class="col-md-4 control-label">Contact Number:</label>

                  <div class="col-md-6">
                     <input id="contact_number_2" type="text" class="form-control" name="contact_number_2" value="{{ old('contact_number_2') }}" required autofocus>

                     @if ($errors->has('contact_number_2'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_number_2') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('email_2') ? ' has-error' : '' }}">
                  <label for="email_2" class="col-md-4 control-label">E-mail:</label>

                  <div class="col-md-6">
                     <input id="email_2" type="email_2" class="form-control" name="email_2" value="{{ old('email_2') }}" required autofocus>

                     @if ($errors->has('email_2'))
                     <span class="help-block">
                        <strong>{{ $errors->first('email_2') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('shorted_list_epc') ? ' has-error' : '' }}">
                  <label for="shorted_list_epc" class="col-md-4 control-label"><b>Shorted List EPC</b>:</label>

                  <div class="col-md-6">
                     <input id="shorted_list_epc" type="text" class="form-control" name="shorted_list_epc" value="{{ old('shorted_list_epc') }}" required autofocus>

                     @if ($errors->has('shorted_list_epc'))
                     <span class="help-block">
                        <strong>{{ $errors->first('shorted_list_epc') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('address_3') ? ' has-error' : '' }}">
                  <label for="address_3" class="col-md-4 control-label">Address:</label>

                  <div class="col-md-6">
                     <input id="address_3" type="text" class="form-control" name="address_3" value="{{ old('address_3') }}" required autofocus>

                     @if ($errors->has('address_3'))
                     <span class="help-block">
                        <strong>{{ $errors->first('address_3') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_person_3') ? ' has-error' : '' }}">
                  <label for="contact_person_3" class="col-md-4 control-label">Contact Person:</label>

                  <div class="col-md-6">
                     <input id="contact_person_3" type="text" class="form-control" name="contact_person_3" value="{{ old('contact_person_3') }}" required autofocus>

                     @if ($errors->has('contact_person_3'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_person_3') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('contact_number_3') ? ' has-error' : '' }}">
                  <label for="contact_number_3" class="col-md-4 control-label">Contact Number:</label>

                  <div class="col-md-6">
                     <input id="contact_number_3" type="text" class="form-control" name="contact_number_3" value="{{ old('contact_number_3') }}" required autofocus>
                     @if ($errors->has('contact_number_3'))
                     <span class="help-block">
                        <strong>{{ $errors->first('contact_number_3') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('email_3') ? ' has-error' : '' }}">
                  <label for="email_3" class="col-md-4 control-label">E-mail:</label>

                  <div class="col-md-6">
                     <input id="email_3" type="text" class="form-control" name="email_3" value="{{ old('email_3') }}" required autofocus>

                     @if ($errors->has('email_3'))
                     <span class="help-block">
                        <strong>{{ $errors->first('email_3') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('approved_vendors_list') ? ' has-error' : '' }}">
                  <label for="approved_vendors_list" class="col-md-4 control-label">Approved Vendors List:</label>

                  <div class="col-md-6">
                     <input id="approved_vendors_list" type="text" class="form-control" name="approved_vendors_list" value="{{ old('approved_vendors_list') }}" required autofocus>

                     @if ($errors->has('approved_vendors_list'))
                     <span class="help-block">
                        <strong>{{ $errors->first('approved_vendors_list') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('requirement') ? ' has-error' : '' }}">
                  <label for="requirement" class="col-md-4 control-label">Requirement:</label>

                  <div class="col-md-6">
                     <input id="requirement" type="text" class="form-control" name="requirement" value="{{ old('requirement') }}" required autofocus>

                     @if ($errors->has('requirement'))
                     <span class="help-block">
                        <strong>{{ $errors->first('requirement') }}</strong>
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

               <div class="form-group{{ $errors->has('award_date') ? ' has-error' : '' }}">
                  <label for="award_date" class="col-md-4 control-label">Award Date:</label>

                  <div class="col-md-6">
                     <div class="input-group">
                        <input id="award_date" type="text" class="form-control" name="award_date" value="{{ old('award_date') }}" required autofocus>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     </div>
                     @if ($errors->has('award_date'))
                     <span class="help-block">
                        <strong>{{ $errors->first('award_date') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('implementation_date') ? ' has-error' : '' }}">
                  <label for="implementation_date" class="col-md-4 control-label">Implementation Date:</label>

                  <div class="col-md-6">
                     <div class="input-group">
                        <input id="implementation_date" type="text" class="form-control" name="implementation_date" value="{{ old('implementation_date') }}" required autofocus>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     </div>
                     @if ($errors->has('implementation_date'))
                     <span class="help-block">
                        <strong>{{ $errors->first('implementation_date') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('execution_date') ? ' has-error' : '' }}">
                  <label for="execution_date" class="col-md-4 control-label">Execution Date:</label>

                  <div class="col-md-6">
                     <div class="input-group">
                        <input id="execution_date" type="text" class="form-control" name="execution_date" value="{{ old('execution_date') }}" required autofocus>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     </div>
                     @if ($errors->has('execution_date'))
                     <span class="help-block">
                        <strong>{{ $errors->first('execution_date') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('bu') ? ' has-error' : '' }}">
                  <label for="bu" class="col-md-4 control-label">BU:</label>

                  <div class="col-md-6">
                     <input id="bu" type="text" class="form-control" name="bu" value="{{ old('bu') }}" required autofocus>

                     @if ($errors->has('bu'))
                     <span class="help-block">
                        <strong>{{ $errors->first('bu') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('bu_reference') ? ' has-error' : '' }}">
                  <label for="bu_reference" class="col-md-4 control-label">BU Reference:</label>

                  <div class="col-md-6">
                     <input id="bu_reference" type="text" class="form-control" name="bu_reference" value="{{ old('bu_reference') }}" required autofocus>

                     @if ($errors->has('bu_reference'))
                     <span class="help-block">
                        <strong>{{ $errors->first('bu_reference') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                  <label for="wpc_reference" class="col-md-4 control-label">WPC Reference:</label>

                  <div class="col-md-6">
                     <input id="wpc_reference" type="text" class="form-control" name="wpc_reference" value="{{ old('wpc_reference') }}" required autofocus>

                     @if ($errors->has('wpc_reference'))
                     <span class="help-block">
                        <strong>{{ $errors->first('wpc_reference') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('affinity_reference') ? ' has-error' : '' }}">
                  <label for="affinity_reference" class="col-md-4 control-label">Affinity Reference:</label>

                  <div class="col-md-6">
                     <input id="affinity_reference" type="text" class="form-control" name="affinity_reference" value="{{ old('affinity_reference') }}" required autofocus>

                     @if ($errors->has('affinity_reference'))
                     <span class="help-block">
                        <strong>{{ $errors->first('affinity_reference') }}</strong>
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
                  <label for="vendors" class="col-md-4 control-label">Vendors:</label>

                  <div class="col-md-6">
                     <input id="vendors" type="text" class="form-control" name="vendors" value="{{ old('vendors') }}" required autofocus>

                     @if ($errors->has('vendors'))
                     <span class="help-block">
                        <strong>{{ $errors->first('vendors') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <!--  -->
               {{-- <div id="uploader">
                  <div class="form-group{{ $errors->has('scanned_file') ? ' has-error' : '' }}">
                     <label for="scanned_file" class="col-md-4 control-label">Scanned Project:</label>

                     <div class="col-md-6">
                        <input id="scanned_file" type="file" class="form-control" name="scanned_file[]" value="{{ old('scanned_file') }}" required autofocus>

                        @if ($errors->has('scanned_file'))
                        <span class="help-block">
                           <strong>{{ $errors->first('scanned_file') }}</strong>
                        </span>
                        @endif
                     </div>
                     <a class="btn btn-success" id="addField"><i class="fa fa-plus"></i></a>
                  </div>
               </div> --}}

               <!--  -->
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
$('.chosen-select').chosen();

$(".clear_input").click(function(e) {
   e.preventDefault();
   $(":input[type='text']").each(function() {
      this.value = "";
   })
});

</script>
@endsection
