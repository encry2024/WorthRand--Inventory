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
         <b>Buy & Resale Proposal</b> was not able to save because of the following reason(s)
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
   <div class="row">

      <div class="col-md-3">
         <div class="list-group">
            <a class="list-group-item" href="#send_proposal" onclick='document.getElementById("SubmitBuyAndSellProposal").submit();' style="font-size: 13px;">
               <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send Proposal
            </a>
            <a class="list-group-item" href="{{ route('search') }}" style="font-size: 13px;">
               <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back
            </a>
         </div>
      </div>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
         <form class="form-horizontal" action="{{ route('se_submit_buy_and_sell_proposal') }}" method="POST" id="SubmitBuyAndSellProposal">
            {{ csrf_field() }}
            <input type="hidden" name="buy_and_sell_proposal_id" value="{{ $buyAndSellProposal->id }}">
            <input type="hidden" name="customer_id" id="customer_id" value="{{ old('customer_id') }}">

            <div class="row">
               <div class="col-lg-12">

                  <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                     <label for="wpc_reference" class="col-sm-2 control-label">WPC REFERENCE</label>
                     <div class="col-sm-5">
                        <input class="form-control" id="wpc_reference" name="wpc_reference" placeholder="WPC Reference" value="{{ old('wpc_reference') }}">
                        @if ($errors->has('wpc_reference'))
                        <span class="help-block">
                           <strong>{{ $errors->first('wpc_reference') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                     <label for="OfficeSold" class="col-sm-2 control-label">Date</label>
                     <div class="col-sm-5">
                        <input disabled name="date" class="form-control" id="Date" placeholder="Date" value="{{ date('Y') }}">
                        @if ($errors->has('date'))
                        <span class="help-block">
                           <strong>{{ $errors->first('date') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
                     <label for="customer_field" class="col-sm-2 control-label">Sold To:</label>
                     <div class="col-sm-5">
                        <input class="form-control" id="customer_field" name="sold" placeholder="Sold To" value="{{ old('sold_to') }}">
                        @if ($errors->has('customer_id'))
                        <span class="help-block">
                           <strong>{{ $errors->first('customer_id') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-5 col-lg-push-2">
                        <textarea disabled name="customer_address" id="customer_address" class="form-control" placeholder="Address">{{ old('customer_address') }}</textarea>
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('invoice_to') ? ' has-error' : '' }}">
                     <label for="ShitpTo" class="col-sm-2 control-label">Invoice To:</label>
                     <div class="col-sm-5">
                        <input name="invoice_to" class="form-control" id="InvoiceTo" placeholder="Invoice To" value="{{ old('invoice_to') }}">
                        @if ($errors->has('invoice_to'))
                        <span class="help-block">
                           <strong>{{ $errors->first('invoice_to') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('invoice_address') ? ' has-error' : '' }}">
                     <div class="col-sm-5 col-lg-push-2">
                        <textarea name="invoice_address" id=invoice_address"" class="form-control" placeholder="Invoice Address">{{ old('invoice_address') }}</textarea>
                        @if ($errors->has('invoice_address'))
                        <span class="help-block">
                           <strong>{{ $errors->first('invoice_address') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('qrc_reference') ? ' has-error' : '' }}">
                     <label for="qrc_reference" class="col-sm-2 control-label">QRC REFERENCE</label>
                     <div class="col-sm-5">
                        <input class="form-control" id="qrc_reference" name="qrc_reference" placeholder="QRC Reference" value="{{ old('qrc_ref') }}">
                        @if ($errors->has('qrc_reference'))
                        <span class="help-block">
                           <strong>{{ $errors->first('qrc_reference') }}</strong>
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
                  <table class="table table-striped">
                     <thead>
                        <th>ITEM NO#</th>
                        <th>MATERIAL NO#</th>
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
                              <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                              <br>
                              <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                              <br>
                              <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                           </td>
                           <td>
                              <div class="form-group{{ $errors->has('quantity.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <input type="text" class="form-control" name="quantity[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ old('quantity.'.$selectedItem->buy_and_sell_proposal_item_id) }}" placeholder="Enter item Quantity">
                                    @if ($errors->has('quantity.'.$selectedItem->buy_and_sell_proposal_item_id))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('quantity.'.$selectedItem->buy_and_sell_proposal_item_id) }}</strong>
                                    </span>
                                    @endif
                                 </div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group{{ $errors->has('price.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ $selectedItem->project_price != '' ? number_format($selectedItem->project_price, 2) : ($selectedItem->after_market_price != '' ? number_format($selectedItem->after_market_price, 2) : number_format($selectedItem->seal_price, 2)) }}" id="itemPricing">
                                    </div>
                                    @if ($errors->has('price.'.$selectedItem->buy_and_sell_proposal_item_id))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('price.'.$selectedItem->buy_and_sell_proposal_item_id) }}</strong>
                                    </span>
                                    @endif
                                 </div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group{{ $errors->has('delivery.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <input type="text" class="form-control" name="delivery[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" placeholder="Enter number of Weeks" value="{{ old('delivery.'.$selectedItem->buy_and_sell_proposal_item_id) }}">
                                       <div class="input-group-addon">Weeks</div>
                                    </div>
                                    @if ($errors->has('delivery.'.$selectedItem->buy_and_sell_proposal_item_id))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('delivery.'.$selectedItem->buy_and_sell_proposal_item_id) }}</strong>
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

            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group{{ $errors->has('validity') ? ' has-error' : '' }}">
                     <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>Validity:</i></b> </label>
                     <div class="col-sm-5">
                        <input name="validity" id="InputValidity" class="form-control" placeholder="Validity" {{ old('validity') }}/>
                        @if ($errors->has('validity'))
                        <span class="help-block">
                           <strong>{{ $errors->first('validity') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                     <label for="InputAmount" class="col-sm-2 control-label">Payment Terms:</label>
                     <div class="col-sm-5">
                        <input class="form-control" id="InputPaymentTerms" name="terms" placeholder="Payment Terms"{{ old('terms') }}>
                        @if ($errors->has('terms'))
                        <span class="help-block">
                           <strong>{{ $errors->first('terms') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
   $('#customer_field').autocomplete({
      serviceUrl: "{{ route('se_fetch_customers') }}",
      dataType: 'json',
      type: 'get',
      onSelect: function (suggestions) {
         document.getElementById('customer_address').value = suggestions.address;
         document.getElementById('customer_id').value = suggestions.id;
      }
   });

   $(":input[id='itemPricing']").on("focusout", function(e) {
      e.preventDefault();
      var itemPricing = this.value
      string = numeral(itemPricing).format('0,0.00');

      this.value = string;
   });
</script>
@stop
