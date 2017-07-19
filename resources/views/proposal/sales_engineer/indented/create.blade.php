@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="row" style="margin-top: -2rem;">
   <div class="alert {{ Session::get('alert') }} alert-dismissible" role="alert" style="border-radius: 0px;">
      <i style="margin-left: 18rem;" class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
      <button style="margin-right: 14rem;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   </div>
</div>
@endif

@if (count($errors) > 0)
<div class="row" style="margin-top: -2rem;">
   <div style="border-radius: 0px;" class="alert search-error alert-dismissible">
      <i class="close icon"></i>
      <div class="header">
         <b>Indented Proposal</b> was not able to save because of the following reason(s)
      </div>
      <ul class="list">
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
</div>
@endif

<div class="col-lg-12">
   <div class="col-md-3">
      <div class="list-group">
         <a class="list-group-item" href="#send_proposal" onclick='document.getElementById("SubmitIndentedProposal").submit();' style="font-size: 13px;">
            <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send Proposal
         </a>
         <a class="list-group-item" href="{{ route('search') }}" style="font-size: 13px;">
            <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
               <h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i>&nbsp;&nbsp;CREATE ORDER ENTRY</h4>
            </div>
         </div>
      </div>

      <form class="form-horizontal" action="{{ route('se_submit_indented_proposal') }}" method="POST" id="SubmitIndentedProposal" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input type="hidden" name="indent_proposal_id" value="{{ $indented_proposal->id }}">
         <input type="hidden" name="customer_id" id="customer_id">

         {{-- <div class="row">
            <div class="col-lg-12">
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
            </div>
         </div> --}}

         <div class="row">
            <div class="col-lg-12">
               <div class="form-group">
                  <label for="uploadPOFile" class="col-sm-3 control-label">Upload P.O File</label>
                  <div class="col-sm-5">
                     <input class="form-control" type="file" id="uploadPOFile" name="fileField">
                  </div>
               </div>

               <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                  <label for="wpc_reference" class="col-sm-3 control-label">WPC Reference: </label>
                  <div class="col-sm-5">
                     <input class="form-control" id="wpc_reference" name="wpc_reference" placeholder="WPC Reference"
                     value="{{ old('wpc_reference') }}">
                     @if ($errors->has('wpc_reference'))
                     <span class="help-block">
                        <strong>{{ $errors->first('wpc_reference') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="" class="col-sm-3 control-label">Date:</label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="{{ date('Y') }}" disabled>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : ($errors->has('branch') ? ' has-error' : '') }}">
                  <label for="OfficeSold" class="col-sm-3 control-label">Sold To:</label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="{{ old('branch') }}" name="branch" id="branch_field" required autofocus placeholder="Customer's Branch Office" />
                     @if ($errors->has('branch_id'))
                     <span class="help-block">
                        <strong>{{ $errors->first('branch_id') }}</strong>
                     </span>
                     @endif
                     @if ($errors->has('branch'))
                     <span class="help-block">
                        <strong>{{ $errors->first('branch_id') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-5 col-lg-push-3">
                     <textarea name="branch_address" id="branch_address" class="form-control" placeholder="Address" disabled>{{ old('branch_address') }}</textarea>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('rfq_number') ? ' has-error' : '' }}">
                  <label for="inputBidNumber" class="col-sm-3 control-label">RFQ/Bid Number:</label>
                  <div class="col-sm-5">
                     <input class="form-control" id="inputBidNumber" name="rfq_number" placeholder="Enter RFQ/Bid Number" value="{{ old('rfq_number') }}">
                     @if ($errors->has('rfq_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('rfq_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group">
                  <label for="inputInvoice" class="col-sm-3 control-label">Invoice To:</label>
                  <div class="col-sm-5">
                     <input class="form-control" id="inputInvoice" name="invoice" placeholder="Enter Invoice" value="{{ $indented_proposal->invoice_to != '' ? $indented_proposal->invoice_to : '' }}">
                     <br>
                     <textarea name="invoice_address" id="" class="form-control" placeholder="Invoice Address">{{ $indented_proposal->invoice_to_address != '' ? $indented_proposal->invoice_to_address : '' }}</textarea>
                  </div>
               </div>

               <div class="form-group">
                  <label for="ShitpTo" class="col-sm-3 control-label">Ship To:</label>
                  <div class="col-sm-5">
                     <input name="ship_to" class="form-control" id="ShitpTo" placeholder="Ship To" value="{{ $indented_proposal->ship_to != '' ? $indented_proposal->ship_to : '' }}">
                     <br>
                     <textarea name="ship_to_address" id="" class="form-control" placeholder="Ship To Address">{{ $indented_proposal->ship_to_address != '' ? $indented_proposal->ship_to_address : '' }}</textarea>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <hr>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <table class="table table-striped">
                  <thead>
                     <th>ITEM NO#</th>
                     <th>Material NO#</th>
                     <th>DESCRIPTION</th>
                     <th>QUANTITY</th>
                     <th>PRICE</th>
                     <th>DELIVERY</th>
                  </thead>

                  <tbody>
                     @foreach($selectedItems as $selectedItem)
                     <tr>
                        <td>{{ ++$ctr }}</td>
                        <td style="width: 13%;">{{ $selectedItem->project_mn != "" ? $selectedItem->project_mn : ($selectedItem->after_market_mn != '' ? $selectedItem->after_market_mn : $selectedItem->seal_material_number) }}</td>
                        <td>
                           <b>NAME:&nbsp;</b>
                           {{ $selectedItem->project_name != "" ? $selectedItem->project_name : ($selectedItem->after_market_name != '' ? $selectedItem->after_market_name : $selectedItem->seal_name) }}
                           <br>
                           <b>PN:&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ($selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number) }}
                           <br>
                           <b>{{ $selectedItem->project_md != "" ? "STATUS" : ($selectedItem->after_market_md != '' ? "MODEL NO" : "MODEL NO") }}.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                           <br>
                           <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                           <br>
                           <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                        </td>
                        <td>
                           <div class="form-group{{ $errors->has('quantity.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                              <div class="col-lg-12">
                                 <input type="text" class="form-control" name="quantity[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ old('quantity.'.$selectedItem->indented_proposal_item_id) }}" placeholder="Enter item Quantity">
                                 @if ($errors->has('quantity.'.$selectedItem->indented_proposal_item_id))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('quantity.'.$selectedItem->indented_proposal_item_id) }}</strong>
                                 </span>
                                 @endif
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="form-group{{ $errors->has('price.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                              <div class="col-lg-12">
                                 <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->project_price != '' ? number_format($selectedItem->project_price, 2) : ($selectedItem->after_market_price != '' ? number_format($selectedItem->after_market_price, 2) : number_format($selectedItem->seal_price, 2)) }}" id="itemPricing">
                                 </div>
                                 @if ($errors->has('price.'.$selectedItem->indented_proposal_item_id))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('price.'.$selectedItem->indented_proposal_item_id) }}</strong>
                                 </span>
                                 @endif
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="form-group{{ $errors->has('delivery.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                              <div class="col-lg-12">
                                 <div class="input-group">
                                    <input type="text" class="form-control" name="delivery[{{ $selectedItem->indented_proposal_item_id }}]" placeholder="Enter No# of Weeks" value="{{ old('delivery.'.$selectedItem->indented_proposal_item_id) }}">
                                    <div class="input-group-addon">Weeks</div>
                                 </div>
                                 @if ($errors->has('delivery.'.$selectedItem->indented_proposal_item_id))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('delivery.'.$selectedItem->indented_proposal_item_id) }}</strong>
                                 </span>
                                 @endif
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </form>
</div>

<script>
$(document).ready(function() {
   var data;
   $('#branch_field').autocomplete({
      serviceUrl: "{{ route('se_fetch_customers') }}",
      dataType: 'json',
      type: 'get',
      onSelect: function (suggestions) {
         document.getElementById('branch_address').value = suggestions.address;
         document.getElementById('customer_id').value = suggestions.id;
      }
   });

   $(":input[id='price']").on("focusout", function(e) {
      e.preventDefault();
      var itemPricing = e.value
      string = numeral(itemPricing).format('0,0.00');

      e.value = string;
   });
});
</script>
@stop
