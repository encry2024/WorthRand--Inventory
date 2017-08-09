@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

   <div class="col-md-3">
      <div class="list-group">
         <a href="{{ route('admin_seal_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
      <div class="panel panel-default">
         <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
            <h4><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;{{ strtoupper($seal->name) }}</h4>
         </div>
      </div>

      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><b>Information</b></a></li>
         <li role="presentation"><a href="#sealFile" aria-controls="sealFile" role="tab" data-toggle="tab"><b>Seal Files</b></a></li>
         <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><b>Pricing History</b></a></li>
         <div class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               Actions
               <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
               <li><a href="{{ route('admin_seal_information', $seal->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit Information</a></li>
               <li><a href="{{ route('admin_seal_pricing_history_create', $seal->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
               <li><a href="javascript:void(0)" class="delete-link" data-toggle="modal" data-target="#DeleteSealModal"><i class="fa fa-trash"></i>&nbsp; Delete Seal</a></li>
            </ul>
         </div>
      </ul>

      <div class="tab-content">
         <div role="tabpanel" class="tab-pane fade in active" id="information">
            <br>
            <div class="row">
               <div class="col-lg-12">
                  <form class="form-horizontal">
                     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name:</label>

                        <div class="col-md-6">
                           <label id="name" class="control-label" name="name">{{ $seal->name }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-4 control-label">Price:</label>

                        <div class="col-md-6">
                           <label id="price" class="control-label" name="price">{{ number_format($seal->price, 2) }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                        <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                        <div class="col-md-6">
                           <label id="drawing_number" class="control-label" name="drawing_number">{{ $seal->drawing_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('bom_number') ? ' has-error' : '' }}">
                        <label for="bom_number" class="col-md-4 control-label">BOM Number:</label>

                        <div class="col-md-6">
                           <label id="bom_number" class="control-label" name="bom_number">{{ $seal->bom_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('end_user') ? ' has-error' : '' }}">
                        <label for="end_user" class="col-md-4 control-label">End User:</label>

                        <div class="col-md-6">
                           <label id="end_user" class="control-label" name="end_user">{{ $seal->end_user }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('seal_type') ? ' has-error' : '' }}">
                        <label for="seal_type" class="col-md-4 control-label">Seal Type:</label>

                        <div class="col-md-6">
                           <label id="seal_type" class="control-label" name="seal_type">{{ $seal->seal_type }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                        <label for="size" class="col-md-4 control-label">Size:</label>

                        <div class="col-md-6">
                           <label id="size" class="control-label" name="size">{{ $seal->size }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('material_code') ? ' has-error' : '' }}">
                        <label for="material_code" class="col-md-4 control-label">Material Number:</label>

                        <div class="col-md-6">
                           <label id="material_code" class="control-label" name="material_code">{{ $seal->material_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="col-md-4 control-label">Code:</label>

                        <div class="col-md-6">
                           <label id="code" class="control-label" name="code">{{ $seal->code }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                        <label for="model" class="col-md-4 control-label">Model:</label>

                        <div class="col-md-6">
                           <label id="model" class="control-label" name="model">{{ $seal->model }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                        <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                        <div class="col-md-6">
                           <label id="serial_number" class="control-label" name="serial_number">{{ $seal->serial_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                        <label for="tag" class="col-md-4 control-label">Tag:</label>

                        <div class="col-md-6">
                           <label id="tag" class="control-label" name="tag">{{ $seal->tag }}</label>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <div role="tabpanel" class="tab-pane fade in" id="sealFile">
            <div class="alert alert-info" role="alert">Reload/Refresh the page after uploading to reflect the changes.</div>
            <br>
            <div class="row">
               <div class="col-lg-12">
                  <div id="dropzone">
                     <form class="dropzone" id="dropZ" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $seal->id }}" name="seal_id">

                     </form>
                  </div>
               </div>
            </div>

            <br><br>

            <div class="row">
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Date Uploaded</th>
                        <th>Action</th>
                     </thead>

                     <tbody>
                        @foreach($seal->upload_seals as $uploaded_seal)
                        <tr>
                           <td>{{ $uploaded_seal->id }}</td>
                           <td>{{ $uploaded_seal->original_filename }}</td>
                           <td>{{ $uploaded_seal->created_at }}</td>
                           <td>
                              <a href="{{ route('seal_open_pdf', $uploaded_seal->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <a href="{{ route('admin_download_file', $uploaded_seal->id) }}" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
                              <a onclick="deleteUploadedSeal({{ $uploaded_seal->id }}, '{{ $uploaded_seal->original_filename }}' )" data-target="#DeletePDFModal" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>

         </div>

         <div role="tabpanel" class="tab-pane fade in" id="pricing_history">
            <br>
            <div class="row">
               <div class="col-lg-12">
                  @if(count($seal->seal_pricing_history) != 0)
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Date Created</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">P.O Number</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Year</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Price ($)</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Terms</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">Delivery</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">FPD Reference</th>
                           <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;">WPC Reference</th>
                        </thead>

                        <tbody>
                           @foreach($seal->seal_pricing_history as $pricing_history)
                           <tr>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($pricing_history->created_at)) }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->po_number }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->pricing_date }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ number_format($pricing_history->price, 2) }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->terms }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->delivery }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->fpd_reference }}</b></td>
                              <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->wpc_reference }}</b></td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  @else
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="alert search-error" role="alert"><b>You have 0 records for {{ $seal->name }}'s Pricing History.</b></div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>

   </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="DeleteSealModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <form action="{{ route('admin_seal_delete', $seal->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-dialog" role="document">
         <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header modal-header-danger" style="padding: 10px;">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <label class="modal-title" id="myModalLabel" style="font-size: 16px; font-weight: normal;"><i class="fa fa-trash"></i>&nbsp;Delete Seal: {{ $seal->name }}</label>
            </div>
            <div class="modal-body">
               <div class="alert alert-info" role="alert" style="border-radius: 0px; padding: 7px; margin-top: -1.6rem; margin-left: -1.5rem; margin-right: -1.5rem; background-image: none;">
                  <label style="margin-left: 2.5rem; padding-top: 2px;"><i class="fa fa-info-circle"></i> You may still recover deleted Seals.</label></div>
                  <label class="control-label" style="font-size: 15px;">Are you sure you want to <code>DELETE</code> {{ strtoupper($seal->name) }}?</label>
                  <br>
               </div>
               <div class="modal-footer" style="padding: 5px; background-color: #e6e6e6; border-top: #ccc solid 1px;">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
               </div>
            </div>
         </div>
      </form>
   </div>

   <div class="modal fade" id="DeletePDFModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <form id="deletePdfForm" method="POST">
         {{ csrf_field() }}
         {{ method_field('DELETE') }}

         <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;">
               <div class="modal-header modal-header-danger" style="padding: 10px;">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <label class="modal-title" id="myModalLabel" style="font-size: 16px; font-weight: normal;"><i class="fa fa-trash"></i>&nbsp;Delete Scanned File: <span id="fileName2"></span></label>
               </div>
               <div class="modal-body">
                  <p>This will permanently delete the scanned file. Are you sure you want to delete <b><span id="fileName1"></span></b>?</p>
               </div>
               <div class="modal-footer" style="padding: 5px; background-color: #e6e6e6; border-top: #ccc solid 1px;">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete Permanently</button>
               </div>
            </div>
         </div>
      </form>
   </div>

   <script type="text/javascript">
   function deleteUploadedSeal(fileId, fileName) {
      var url = "{{ route('admin_delete_file_seal', ':fileId') }}";
      url = url.replace(':fileId', fileId);

      document.getElementById('deletePdfForm').action = url;
      document.getElementById('fileName1').innerHTML = fileName;
      document.getElementById('fileName2').innerHTML = fileName;
   }

   $(function() {
      Dropzone.autoDiscover = false;

      var dropzoneField = new Dropzone("#dropZ", {
         url: "{{ route('admin_upload_file_seal', $seal->id) }}",
         addRemoveLinks: true,
         dictDefaultMessage: "-Drag your files, or click to upload."
      });
   });
   </script>
   @endsection
