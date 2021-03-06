@extends('layouts.app')

@section('header')
@include('layouts.header')
@stop

@section('content')
<div class="container">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <div class="col-md-3">
         <div class="list-group">
            <a href="{{ route('se_project_index') }}" class="list-group-item {!! Request::route()->getName() == 'se_dashboard' ? 'active' : '' !!}" style="font-size: 13px;">
               <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
            </a>
         </div>
      </div>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
         <div class="row">
            <div class="panel panel-default">
               <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                  <h4><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;{{ strtoupper($project->name) }}</h4>
               </div>
            </div>
         </div>

         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> Information</a></li>
            <li role="presentation"><a href="#pricing_history" aria-controls="pricing_history" role="tab" data-toggle="tab"><i class="fa fa-history" aria-hidden="true"></i> Pricing History</a></li>
         </ul>

         <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="information">
               <br>
               <div class="row">
                  <div class="col-lg-12">
                     <form class="form-horizontal">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">
                           <label for="customer_name" class="col-md-4 control-label">Customer Name:</label>

                           <div class="col-md-6" style="margin-top: 0.7rem;">
                              <a id="customer_name" href="{{ route('admin_show_customer', $project->customer->id) }}" class="control-label">{{ $project->customer->name }}</a>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <label for="name" class="col-md-4 control-label">Project Name:</label>

                           <div class="col-md-6">
                              <label id="name" class="control-label">{{ $project->name }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('project_terms') ? ' has-error' : '' }}">
                           <label for="project_terms" class="col-md-4 control-label">Project Terms:</label>

                           <div class="col-md-6">
                              <label id="project_terms" class="control-label">{{ $project->project_terms }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                           <label for="source" class="col-md-4 control-label">Source:</label>

                           <div class="col-md-6">
                              <label id="source" class="control-label">{{ $project->source }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                           <label for="address_1" class="col-md-4 control-label">Address:</label>

                           <div class="col-md-6">
                              <label id="address_1" class="control-label">{{ $project->address_1 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_person_1') ? ' has-error' : '' }}">
                           <label for="contact_person_1" class="col-md-4 control-label">Contact Person:</label>

                           <div class="col-md-6">
                              <label id="contact_person_1" class="control-label">{{ $project->contact_person_1 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('consultant') ? ' has-error' : '' }}">
                           <label for="consultant" class="col-md-4 control-label">Consultant:</label>

                           <div class="col-md-6">
                              <label id="consultant" class="control-label">{{ $project->consultant }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                           <label for="address_2" class="col-md-4 control-label">Address:</label>

                           <div class="col-md-6">
                              <label id="address_2" class="control-label">{{ $project->address_2 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_person_2') ? ' has-error' : '' }}">
                           <label for="contact_person_2" class="col-md-4 control-label">Contact Person:</label>

                           <div class="col-md-6">
                              <label id="contact_person_2" class="control-label">{{ $project->contact_person_2 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_number_2') ? ' has-error' : '' }}">
                           <label for="contact_number_2" class="col-md-4 control-label">Contact Number:</label>

                           <div class="col-md-6">
                              <label id="contact_number_2" class="control-label">{{ $project->contact_number_2 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('email_2') ? ' has-error' : '' }}">
                           <label for="email_2" class="col-md-4 control-label">Contact Person:</label>

                           <div class="col-md-6">
                              <label id="email_2" class="control-label">{{ $project->email_2 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('shorted_list_epc') ? ' has-error' : '' }}">
                           <label for="shorted_list_epc" class="col-md-4 control-label">Shorted List EPC:</label>

                           <div class="col-md-6">
                              <label id="shorted_list_epc" class="control-label">{{ $project->shorted_list_epc }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_3') ? ' has-error' : '' }}">
                           <label for="address_3" class="col-md-4 control-label">Address:</label>

                           <div class="col-md-6">
                              <label id="address_3" class="control-label">{{ $project->address_3 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_person_3') ? ' has-error' : '' }}">
                           <label for="contact_person_3" class="col-md-4 control-label">Contact Person:</label>

                           <div class="col-md-6">
                              <label id="contact_person_3" class="control-label">{{ $project->contact_person_3 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_number_3') ? ' has-error' : '' }}">
                           <label for="contact_number_3" class="col-md-4 control-label">Contact Number:</label>

                           <div class="col-md-6">
                              <label id="contact_number_3" class="control-label">{{ $project->contact_number_3 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('email_3') ? ' has-error' : '' }}">
                           <label for="email_3" class="col-md-4 control-label">Contact Person:</label>

                           <div class="col-md-6">
                              <label id="email_3" class="control-label">{{ $project->email_3 }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('approved_vendors_list') ? ' has-error' : '' }}">
                           <label for="approved_vendors_list" class="col-md-4 control-label">Approved Vendors List:</label>

                           <div class="col-md-6">
                              <label id="approved_vendors_list" class="control-label">{{ $project->approved_vendors_list }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('requirement') ? ' has-error' : '' }}">
                           <label for="requirement" class="col-md-4 control-label">Requirement:</label>

                           <div class="col-md-6">
                              <label id="requirement" class="control-label">{{ $project->requirement }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('epc_award') ? ' has-error' : '' }}">
                           <label for="epc_award" class="col-md-4 control-label">EPC Award:</label>

                           <div class="col-md-6">
                              <label id="epc_award" class="control-label">{{ $project->epc_award }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('award_date') ? ' has-error' : '' }}">
                           <label for="award_date" class="col-md-4 control-label">Award Date:</label>

                           <div class="col-md-6">
                              <label id="award_date" class="control-label">{{ $project->award_date }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('implementation_date') ? ' has-error' : '' }}">
                           <label for="implementation_date" class="col-md-4 control-label">Implementation Date:</label>

                           <div class="col-md-6">
                              <label id="implementation_date" class="control-label">{{ $project->implementation_date }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('execution_date') ? ' has-error' : '' }}">
                           <label for="execution_date" class="col-md-4 control-label">Execution Date:</label>

                           <div class="col-md-6">
                              <label id="execution_date" class="control-label">{{ $project->execution_date }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('bu') ? ' has-error' : '' }}">
                           <label for="bu" class="col-md-4 control-label">BU:</label>

                           <div class="col-md-6">
                              <label id="bu" class="control-label">{{ $project->bu }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('bu_reference') ? ' has-error' : '' }}">
                           <label for="bu_reference" class="col-md-4 control-label">BU Reference:</label>

                           <div class="col-md-6">
                              <label id="bu_reference" class="control-label">{{ $project->bu_reference }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                           <label for="wpc_reference" class="col-md-4 control-label">WPC Reference:</label>

                           <div class="col-md-6">
                              <label id="wpc_reference" class="control-label">{{ $project->wpc_reference }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('affinity_reference') ? ' has-error' : '' }}">
                           <label for="affinity_reference" class="col-md-4 control-label">Affinity Reference:</label>

                           <div class="col-md-6">
                              <label id="affinity_reference" class="control-label">{{ $project->affinity_reference }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                           <label for="value" class="col-md-4 control-label">Value:</label>

                           <div class="col-md-6">
                              <label id="value" class="control-label">{{ $project->value }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                           <label for="status" class="col-md-4 control-label">Status:</label>

                           <div class="col-md-6">
                              <label id="status" class="control-label">{{ $project->status }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('reference_number') ? ' has-error' : '' }}">
                           <label for="reference_number" class="col-md-4 control-label">Reference Number:</label>

                           <div class="col-md-6">
                              <label id="reference_number" class="control-label">{{ $project->reference_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('drawing_number') ? ' has-error' : '' }}">
                           <label for="drawing_number" class="col-md-4 control-label">Drawing Number:</label>

                           <div class="col-md-6">
                              <label id="drawing_number" class="control-label">{{ $project->drawing_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                           <label for="price" class="col-md-4 control-label">Price:</label>

                           <div class="col-md-6">
                              <label id="price" class="control-label">{{ number_format($project->price, 2) }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('material_number') ? ' has-error' : '' }}">
                           <label for="material_number" class="col-md-4 control-label">Material Number:</label>

                           <div class="col-md-6">
                              <label id="material_number" class="control-label">{{ $project->material_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                           <label for="serial_number" class="col-md-4 control-label">Serial Number:</label>

                           <div class="col-md-6">
                              <label id="serial_number" class="control-label">{{ $project->serial_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('tag_number') ? ' has-error' : '' }}">
                           <label for="tag_number" class="col-md-4 control-label">Tag Number:</label>

                           <div class="col-md-6">
                              <label id="tag_number" class="control-label">{{ $project->tag_number }}</label>
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('final_result') ? ' has-error' : '' }}">
                           <label for="final_result" class="col-md-4 control-label">Final Result:</label>

                           <div class="col-md-6">
                              <label id="final_result" class="control-label">{{ $project->final_result }}</label>
                           </div>
                        </div>

                     </form>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="pricing_history">
               <br>
               <div class="row">
                  <div class="col-lg-12">
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
                              <th style="background-color: #428bca; color: white; border-right: #ddd 1px solid;" class="text-right">WPC Reference</th>
                           </thead>

                           <tbody>
                              @foreach($project->project_pricing_history as $pricing_history)
                              <tr>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ date('m/d/Y', strtotime($pricing_history->created_at)) }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->po_number }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->pricing_date }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ number_format($pricing_history->price, 2) }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->terms }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->delivery }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;"><b>{{ $pricing_history->fpd_reference }}</b></td>
                                 <td style="border: none; border-bottom: 1px solid #ddd;" class="text-right"><b>{{ $pricing_history->wpc_reference }}</b></td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
@endsection
