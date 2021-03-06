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
         <a href="{{ route('admin_after_market_index') }}" class="list-group-item" style="font-size: 13px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($afterMarket->name) }}</h4>
            </div>
         </div>
      </div>

      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active" style="margin-left: 3rem;"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><b>Information</b></a></li>
         <li role="presentation"><a href="#scanned_aftermarkets" aria-controls="scanned_aftermarkets" role="tab" data-toggle="tab"><b>Scanned Aftermarkets</b></a></li>
         <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><b>Pricing History</b></a></li>
         <div class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle" style="text-shadow: none !important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               Actions
               <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top: 0.55rem; margin-right: -4rem;">
               <li><a href="{{ route('admin_after_market_information', $afterMarket->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit Information</a></li>
               <li><a href="{{ route('admin_after_market_pricing_history_create', $afterMarket->id) }}"><i class="fa fa-plus"></i>&nbsp; Add Pricing History</a></li>
               <li><a href="javascript:void(0)" class="delete-link" data-toggle="modal" data-target="#DeleteAftermarketModal"><i class="fa fa-trash"></i>&nbsp; Delete Aftermarket</a></li>
            </ul>
         </div>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane fade in active" id="information">
            <br>
            <div class="row">
               <div class="col-lg-12">
                  <form class="form-horizontal">
                     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name:</label>

                        <div class="col-md-6">
                           <label id="name" class="control-label" name="name">{{ $afterMarket->name }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                        <label for="model" class="col-md-4 control-label">Model:</label>

                        <div class="col-md-6">
                           <label id="model" class="control-label">{{ $afterMarket->model }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('ccn_number') ? ' has-error' : '' }}">
                        <label for="ccn_number" class="col-md-4 control-label">CCN Number:</label>

                        <div class="col-md-6">
                           <label id="ccn_number" class="control-label">{{ $afterMarket->ccn_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('part_number') ? ' has-error' : '' }}">
                        <label for="part_number" class="col-md-4 control-label">Part Number:</label>

                        <div class="col-md-6">
                           <label id="part_number" class="control-label">{{ $afterMarket->part_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                        <label for="reference_number" class="col-md-4 control-label">Reference Number:</label>

                        <div class="col-md-6">
                           <label id="reference_number" class="control-label">{{ $afterMarket->reference_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                        <label for="material_number" class="col-md-4 control-label">Material Number:</label>

                        <div class="col-md-6">
                           <label id="material_number" class="control-label"> {{ $afterMarket->material_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                        <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                        <div class="col-md-6">
                           <label id="serial_number" class="control-label">{{ $afterMarket->serial_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('tag_number') ? ' has-error' : '' }}">
                        <label for="tag_number" class="col-md-4 control-label">Tag Number:</label>

                        <div class="col-md-6">
                           <label id="tag_number" class="control-label">{{ $afterMarket->tag_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                        <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                        <div class="col-md-6">
                           <label id="drawing_number" class="control-label">{{ $afterMarket->drawing_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('stock_number') ? ' has-error' : '' }}">
                        <label for="stock_number" class="col-md-4 control-label">Stock Number:</label>

                        <div class="col-md-6">
                           <label id="stock_number" class="control-label">{{ $afterMarket->stock_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('sap_number') ? ' has-error' : '' }}">
                        <label for="sap_number" class="col-md-4 control-label">SAP Number:</label>

                        <div class="col-md-6">
                           <label id="sap_number" class="control-label">{{ $afterMarket->sap_number }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Description:</label>

                        <div class="col-md-6">
                           <label id="description" class="control-label">{{ $afterMarket->description }}</label>
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('scanned_file') ? ' has-error' : '' }}">
                        <label for="drawing_number" class="col-md-4 control-label">Scanned Aftermarket:</label>

                        <div class="col-md-6">
                           <label id="drawing_number" class="control-label">{{ $afterMarket->scanned_file }}</label>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <div role="tabpanel" class="tab-pane fade in" id="scanned_aftermarkets">
            <br>
            <div class="row">
               <div class="col-lg-12">
                  <div id="dropzone">
                     <form class="dropzone" id="dropZ" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $afterMarket->id }}" name="aftermarket_id">

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
                        @foreach($afterMarket->aftermarket_uploads as $aftermarket_upload)
                        <tr>
                           <td>{{ $aftermarket_upload->id }}</td>
                           <td>{{ $aftermarket_upload->original_filename }}</td>
                           <td>{{ $aftermarket_upload->created_at }}</td>
                           <td>
                              <a href="{{ route('aftermarket_open_pdf', $aftermarket_upload->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a>
                              <a href="{{ route('admin_download_aftermarket_file', $aftermarket_upload->id) }}" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
                              <a onclick="deleteUploadedafterMarket({{ $aftermarket_upload->id }}, '{{ $aftermarket_upload->original_filename }}' )" data-target="#DeletePDFModal" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                  @if(count($afterMarket->after_market_pricing_history) != 0)
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
                           @foreach($afterMarket->after_market_pricing_history as $pricing_history)
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
                        <div class="alert search-error" role="alert"><b>You have 0 records for {{ $afterMarket->name }}'s Pricing History.</b></div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>

   </div>
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

<div class="modal fade" id="DeleteAftermarketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <form action="{{ route('admin_aftermarket_delete', $afterMarket->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-dialog" role="document">
         <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header modal-header-danger" style="padding: 10px;">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <label class="modal-title" id="myModalLabel" style="font-size: 16px; font-weight: normal;"><i class="fa fa-trash"></i>&nbsp;Delete Aftermarket: {{ $afterMarket->name }}</label>
            </div>
            <div class="modal-body">
               <label class="control-label" style="font-size: 15px;">Are you sure you want to <code>DELETE</code> {{ strtoupper($afterMarket->name) }}?</label>
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

<script type="text/javascript">
function deleteUploadedafterMarket(fileId, fileName) {
   var url = "{{ route('admin_delete_file_on_aftermarket', ':fileId') }}";
   url = url.replace(':fileId', fileId);

   document.getElementById('deletePdfForm').action = url;
   document.getElementById('fileName1').innerHTML = fileName;
   document.getElementById('fileName2').innerHTML = fileName;
}

$(function() {
   Dropzone.autoDiscover = false;

   var dropzoneField = new Dropzone("#dropZ", {
      url: "{{ route('admin_upload_file_aftermarket', $afterMarket->id) }}",
      addRemoveLinks: true,
      dictDefaultMessage: "-Drag your files, or click to upload."
   });
});
</script>
@endsection
