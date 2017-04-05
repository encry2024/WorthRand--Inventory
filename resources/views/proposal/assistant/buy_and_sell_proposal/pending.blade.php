@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="row" style="margin-top: -2rem;">
   <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
      <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
   </div>
</div>
@endif
<div class="col-lg-12">
   @if(($buyAndSellProposal->collection_status == "DELIVERY") || ($buyAndSellProposal->collection_status == "FOR-COLLECTION"))
   <div class="alert alert-success" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
      <i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>This Indented Proposal is in {{ $buyAndSellProposal->collection_status }} process...</b>
   </div>
   @endif
   <div class="row">

      <div class="col-md-3">
         <div class="list-group">
            @if(($buyAndSellProposal->collection_status == "DELIVERY"))
            <a data-toggle="modal" data-target="#BuyAndResaleProposalFormConfirmation" class="list-group-item" style="font-size: 13px;">
               <i class="fa fa-paper-plane"></i>&nbsp; Accept Proposal
            </a>
            @endif
            <a  href="{{ route('assistant_dashboard') }}" class="list-group-item" style="font-size: 13px;">
               <i class="fa fa-arrow-left"></i>&nbsp; Back
            </a>
         </div>
      </div>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">

         <form class="form-horizontal" action="{{ route('assistant_accept_buy_and_sell_proposal', $buyAndSellProposal->id) }}" method="POST" id="AcceptBuyAndSellProposal" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <input type="hidden" name="buyAndSellProposal_id" value="{{ $buyAndSellProposal->id }}">

            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group">
                     <label for="purchase_order" class="col-sm-2 control-label">P.O: </label>
                     <div class="col-sm-5">
                        <input {{ $buyAndSellProposal->purchase_order != '' ? "disabled" : "" }} class="form-control" id="purchase_order" name="purchase_order" placeholder="Purchase Order Number" value="{{ $buyAndSellProposal->purchase_order != '' ? $buyAndSellProposal->purchase_order : old('purchase_order') }}" >
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="wpc_reference" class="col-sm-2 control-label">WPC REFERENCE</label>
                     <div class="col-sm-5">
                        <input disabled class="form-control" id="wpc_reference" name="wpc_reference" placeholder="WPC Reference" value="{{ $buyAndSellProposal->wpc_reference }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="OfficeSold" class="col-sm-2 control-label">Date</label>
                     <div class="col-sm-5">
                        <input disabled name="date" class="form-control" id="Date" placeholder="Date" value="{{ $buyAndSellProposal->date }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="branch_field" class="col-sm-2 control-label">Sold To:</label>
                     <div class="col-sm-5">
                        <input disabled class="form-control" id="branch_field" name="sold" placeholder="Sold To" value="{{ $buyAndSellProposal->customer->name }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-5 col-lg-push-2">
                        <textarea disabled name="to_address" id="to_address" class="form-control" placeholder="Address">{{ $buyAndSellProposal->customer->address }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="ShitpTo" class="col-sm-2 control-label">Invoice To:</label>
                     <div class="col-sm-5">
                        <input disabled name="invoice_to" class="form-control" id="InvoiceTo" placeholder="Invoice To" value="{{ $buyAndSellProposal->invoice_to }}">

                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-5 col-lg-push-2">
                        <textarea disabled name="invoice_address" id=invoice_address"" class="form-control" placeholder="Invoice Address">{{ $buyAndSellProposal->invoice_address }}</textarea>

                     </div>
                  </div>

                  <div class="form-group">
                     <label for="qrc_reference" class="col-sm-2 control-label">QRC REFERENCE</label>
                     <div class="col-sm-5">
                        <input disabled class="form-control" id="qrc_reference" name="qrc_reference" placeholder="QRC Reference" value="{{ $buyAndSellProposal->qrc_ref }}">

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
                        <th>MATERIAL CODE</th>
                        <th>DESCRIPTION</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>
                        <th>DELIVERY</th>
                        <th>Notify me After</th>
                        <th></th>
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
                              <b>{{ $selectedItem->project_pn != "" ? "PN" : ($selectedItem->after_market_pn != '' ? "PN" : "BOM#") }} :&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ($selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number) }}
                              <br>
                              <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                              <br>
                              <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                              <br>
                              <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                           </td>
                           <td><input disabled type="text" class="form-control" name="quantity-{{ $selectedItem->buy_and_sell_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_price }}"></td>
                           <td>
                              <div class="form-group{{ $errors->has('price.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input disabled type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ number_format($selectedItem->buy_and_sell_proposal_item_price, 2) }}">
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group{{ $errors->has('delivery.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <input disabled type="text" class="form-control" name="delivery-{{ $selectedItem->buy_and_sell_proposal_item_id }}" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery / 7 : $selectedItem->delivery }}">
                                       <div class="input-group-addon">Weeks</div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <input disabled type="text" class="form-control" name="delivery[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ $selectedItem->delivery != "" ? $selectedItem->notify_me_after / 7 : $selectedItem->notify_me_after / 7 }}">
                                       <div class="input-group-addon">Weeks</div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           @if($selectedItem->status != "DELIVERED")
                           <td style="width: 15%;">
                              <div class="dropdown">
                                 <button class="btn {{ $selectedItem->status == "DELAYED" ? "btn-danger" : "btn-default" }} dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    {{ $selectedItem->status }}
                                    <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#delivered" data-toggle="modal" data-target="#deliverForm" onclick="getDeliveredItem({{ $selectedItem->buy_and_sell_proposal_item_id }});"><span class="glyphicon glyphicon-ok"></span> Delivered</a></li>
                                    <li><a href="#update_notification" data-toggle="modal" data-target="#updateNotifyMeForm" onclick="getNotifyMe({{ $selectedItem->buy_and_sell_proposal_item_id }});"><span class="glyphicon glyphicon-pushpin"></span> Notify Me</a></li>
                                    <li><a href="#delayed" data-toggle="modal" data-target="#updateDeliveryStatusForm" onclick="getDeliveryStatus({{ $selectedItem->buy_and_sell_proposal_item_id }});"><span class="glyphicon glyphicon-warning-sign"></span> Delayed</a></li>
                                 </ul>
                              </div>
                           </td>
                           @elseif($selectedItem->status == "DELIVERED")
                           <td>
                              <label style="font-size: 14px;" class="label label-success">DELIVERED</label>
                           </td>
                           @endif
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="row">
               <hr>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group">
                     <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>Validity:</i></b> </label>
                     <div class="col-sm-5">
                        <input disabled name="validity" id="InputValidity" class="form-control" placeholder="Validity" value="{{ $buyAndSellProposal->validity }}"/>

                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputAmount" class="col-sm-2 control-label">Payment Terms:</label>
                     <div class="col-sm-5">
                        <input disabled class="form-control" id="InputPaymentTerms" name="terms" placeholder="Payment Terms" value="{{ $buyAndSellProposal->payment_terms }}">
                     </div>
                  </div>
               </div>
            </div>
         </form>

      </div>
   </div>
</div>

<form class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="deliverForm" method="POST">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}
   <input type="hidden" name="buy_and_sell_proposal_id" id="basp_id">

   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Updating Item Delivery Status</h3>
         </div>
         <div class="modal-body" style="line-height: 2.5rem;font-size: 15px;">
            <label for="">You are about to change the item's status to delivered...</label>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Change to Delivered</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</form>

<form class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="updateNotifyMeForm" method="POST">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}
   <input type="hidden" name="buy_and_sell_proposal_item_id" id="basp_id">

   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Updating Notify Me Scheduled Date</h3>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label class="control-label col-sm-3">Notification Date:</label>
               <div class="col-lg-8">
                  <div class="input-group">
                     <input type="text" class="form-control" name="notify_me_after">
                     <div class="input-group-addon">Weeks</div>
                  </div>
               </div>
            </div>
            {{--You are about to changed the <label class="label label-info" style="color: black;">Notify Me After</label> of this item. The System will notify you about the delivery status of this item based on the number of weeks you set on the <label class="label label-info" style="color: black;">Notify Me After</label> column.--}}
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Change Notification Date</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</form>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="BuyAndResaleProposalFormConfirmation">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Accept Buy and Resale Proposal</h4>
         </div>
         <div class="modal-body">
            <label for="">Are you sure you want to accept Proposal <b>[ WPC Number/Reference: {{ $buyAndSellProposal->wpc_reference }} ]</b> ?</label>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick='document.getElementById("AcceptBuyAndSellProposal").submit();'>Accept</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<form class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="updateDeliveryStatusForm" method="POST">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}
   <input type="hidden" name="buy_and_sell_proposal_item_id" id="basp_id">

   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Change Delivery Statys</h3>
         </div>
         <div class="modal-body">
            <p>You are about to change the delivery status of this item to </p>
            {{--You are about to changed the <label class="label label-info" style="color: black;">Notify Me After</label> of this item. The System will notify you about the delivery status of this item based on the number of weeks you set on the <label class="label label-info" style="color: black;">Notify Me After</label> column.--}}
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Change Delivery Status</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</form>

<form class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="updateNotifyMeForm" method="POST">
   {{ method_field('PATCH') }}
   {{ csrf_field() }}
   <input type="hidden" name="buy_and_sell_proposal_item_id" id="basp_id">

   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Updating Notify Me Scheduled Date</h3>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label class="control-label col-sm-3">Notification Date:</label>
               <div class="col-lg-8">
                  <div class="input-group">
                     <input type="text" class="form-control" name="notify_me_after">
                     <div class="input-group-addon">Weeks</div>
                  </div>
               </div>
            </div>
            {{--You are about to changed the <label class="label label-info" style="color: black;">Notify Me After</label> of this item. The System will notify you about the delivery status of this item based on the number of weeks you set on the <label class="label label-info" style="color: black;">Notify Me After</label> column.--}}
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Change Notification Date</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</form>

<script>
function getDeliveredItem(buy_and_sell_proposal_id)
{
   var deliverFormAction = "{{ route('change_buy_and_sell_item_delivery_status', ':buy_and_sell_proposal_id') }}";
   deliverFormAction = deliverFormAction.replace(':buy_and_sell_proposal_id', buy_and_sell_proposal_id);
   document.getElementById("basp_id").value = buy_and_sell_proposal_id;
   document.getElementById("deliverForm").action = deliverFormAction;
}

function getNotifyMe(buy_and_sell_proposal_item_id)
{
   var deliverFormAction = "{{ route('change_item_notify_me_date', ':buy_and_sell_proposal_item_id') }}";
   deliverFormAction = deliverFormAction.replace(':buy_and_sell_proposal_item_id', buy_and_sell_proposal_item_id);
   document.getElementById("basp_id").value = buy_and_sell_proposal_item_id;
   document.getElementById("updateNotifyMeForm").action = deliverFormAction;
}

function getDeliveryStatus(buy_and_sell_proposal_item_id)
{
   var deliverFormAction = "{{ route('change_buy_and_sell_proposal_delivery_status_to_delayed', ':buy_and_sell_proposal_item_id') }}";
   deliverFormAction = deliverFormAction.replace(':buy_and_sell_proposal_item_id', buy_and_sell_proposal_item_id);
   document.getElementById("basp_id").value = buy_and_sell_proposal_item_id;
   document.getElementById("updateDeliveryStatusForm").action = deliverFormAction;
}
</script>
@stop
