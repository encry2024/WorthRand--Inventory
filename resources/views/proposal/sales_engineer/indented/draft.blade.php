@extends('layouts.app')

@section('content')
<div class="col-lg-12">

   <div class="col-md-3">
      <div class="list-group">
         <a class="list-group-item" href="#send_proposal" onclick='document.getElementById("SubmitIndentedProposal").submit();' style="font-size: 13px;">
            <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send Proposal
         </a>
         <a class="list-group-item" href="{{ route('se_dashboard') }}">
            <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
         </a>
      </div>
   </div>

   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <form class="form-horizontal" action="{{ route('se_submit_indented_proposal') }}" method="POST" id="SubmitIndentedProposal" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input type="hidden" name="indent_proposal_id" value="{{ $indentedProposal->id }}">
         <input type="hidden" name="customer_id" id="customer_id">

         <div class="row">
            <div class="col-lg-12">
               <div class="form-group">
                  <label for="uploadPOFile" class="col-sm-2 control-label">Upload P.O File</label>
                  <div class="col-sm-5">
                     <input class="form-control" type="file" id="uploadPOFile" name="fileField">
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                  <label for="wpc_reference" class="col-sm-2 control-label">WPC Reference: </label>
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
                  <label for="" class="col-sm-2 control-label">Date:</label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="{{ date('Y') }}" disabled>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('customer_id') ? ' has-error' : ($errors->has('branch') ? ' has-error' : '') }}">
                  <label for="OfficeSold" class="col-sm-2 control-label">Sold To:</label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="{{ old('branch') }}" name="branch" id="customer_field" required autofocus placeholder="Customer's Branch Office" />
                     @if ($errors->has('customer_id'))
                     <span class="help-block">
                        <strong>{{ $errors->first('customer_id') }}</strong>
                     </span>
                     @endif
                     @if ($errors->has('branch'))
                     <span class="help-block">
                        <strong>{{ $errors->first('customer_id') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-5 col-lg-push-2">
                     <textarea name="customer_address" id="customer_address" class="form-control" placeholder="Address" disabled>{{ old('customer_address') }}</textarea>
                  </div>
               </div>

               <div class="form-group{{ $errors->has('rfq_number') ? ' has-error' : '' }}">
                  <label for="inputBidNumber" class="col-sm-2 control-label">RFQ/Bid Number:</label>
                  <div class="col-sm-5">
                     <input class="form-control" id="inputBidNumber" name="rfq_number" placeholder="Enter RFQ/Bid Number" value="{{ old('rfq_number') }}">
                     @if ($errors->has('rfq_number'))
                     <span class="help-block">
                        <strong>{{ $errors->first('rfq_number') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>


            </div>
         </div>

         <div class="row">
            <hr>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <table class="table">
                  <thead>
                     <th>ITEM NO#</th>
                     <th>DESCRIPTION</th>
                     <th>QUANTITY</th>
                     <th>PRICE</th>
                     <th>DELIVERY</th>
                  </thead>

                  <tbody>
                     @foreach($selectedItems as $selectedItem)
                     <tr>
                        <td>{{ ++$ctr }}</td>
                        <td>
                           <b>NAME:&nbsp;</b>
                           {{ $selectedItem->project_name != "" ? $selectedItem->project_name : ( $selectedItem->after_market_name != '' ? $selectedItem->after_market_name : $selectedItem->seal_name ) }}
                           <br>
                           <b>PN/BOM Number:&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ( $selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number ) }}
                           <br>
                           <b>{{ $selectedItem->project_md != "" ? "STATUS" : ($selectedItem->after_market_md != '' ? "MODEL NO." : "MODEL NO.") }}:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : $selectedItem->after_market_md }}
                           <br>
                           <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : $selectedItem->after_market_dn }}
                           <br>
                           <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : $selectedItem->after_market_tn }}
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
                                    <input type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->project_price != "" ? number_format($selectedItem->project_price, 2) : number_format($selectedItem->after_market_price, 2)  }}">
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
                                    <input type="text" class="form-control" name="delivery[{{ $selectedItem->indented_proposal_item_id }}]" placeholder="Enter number of Weeks" value="{{ old('delivery.'.$selectedItem->indented_proposal_item_id) }}">
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

         <div class="row">
            <hr>
         </div>

      </form>
   </div>
</div>

<script>
$(document).ready(function() {
   var data;

   $('#customer_field').autocomplete({
      serviceUrl: "{{ URL::to('/') }}/{{ Auth::user()->role }}/fetch_customers/",
      dataType: 'json',
      type: 'get',
      onSelect: function (suggestions) {
         document.getElementById('customer_address').value = suggestions.address;
         document.getElementById('customer_id').value = suggestions.customer_id;
      }
   });
});
</script>
@stop
