@extends('layouts.app')

@section('content')
<div class="row" style="margin-top: -2rem;">
   <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
      <b><i style="margin-left: 18rem;" class="fa fa-flag"></i>&nbsp;&nbsp;This proposal is already completed.</b>
   </div>
</div>


<div class="col-lg-12">
   <div class="row">

      <div class="col-md-3">
         <div class="list-group">
            <a href="{{ route('admin_export_pending_proposal', $indented_proposal->id) }}" class="list-group-item"><i class="fa fa-download"></i>&nbsp; Export to XLSX</a>
            <a href="{{ route('admin_dashboard') }}" class="list-group-item" style="font-size: 13px;"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
         </div>
      </div>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
         <form class="form-horizontal">
            {{ csrf_field() }}

            <div class="row">
               <div class="panel panel-default">
                  <div class="panel-heading" style="border-top: saddlebrown 3px solid;">
                     <h4><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;CHEQUE DETAILS</h4>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group">
                     <label for="company_name" class="col-sm-2 control-label">Company Name: </label>
                     <div class="col-sm-5">
                        <input disabled class="form-control" id="company_name" name="company_name" placeholder="Company Name"
                        value="{{ $cheque->company_name }}" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="amount" class="col-sm-2 control-label">Amount: </label>
                     <div class="col-sm-5 ">
                        <div class="input-group">
                           <div class="input-group-addon">$</div>
                           <input disabled class="form-control" id="amount" name="amount" placeholder="Amount (USD) " value="{{ number_format($cheque->amount, 2) }}" required>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </form>

         <div class="row">
            <hr>
         </div>

         <form class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
               <label for="OrderEntryNumber" class="col-sm-2 control-label">Order Entry Number: </label>
               <div class="col-sm-5 ">
                  <input disabled class="form-control" id="OrderEntryNumber" name="order_entry_no" placeholder="Order Entry Number" value="{{ $indentedProposal->order_entry_no }}" required>
               </div>
            </div>

            <div class="row">
               <hr>
            </div>


            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group">
                     <label for="purchase_order" class="col-sm-2 control-label">P.O: </label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="purchase_order" name="purchase_order" placeholder="Purchase Order Number"
                        value="{{ $indentedProposal->purchase_order != '' ? $indentedProposal->purchase_order : '' }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="main_company" class="col-sm-2 control-label">To: </label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="main_company" name="to" placeholder="To" value="{{ $indentedProposal->customer->name }}">
                        <br>
                        <textarea disabled name="to_address" id="" class="form-control" placeholder="Address">{{ $indentedProposal->customer->address }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="inputInvoice" class="col-sm-2 control-label">Invoice To:</label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="inputInvoice" name="invoice" placeholder="Enter Invoice" value="{{ $indentedProposal->invoice_to != '' ? $indentedProposal->invoice_to : '' }}">
                        <br>
                        <textarea disabled name="invoice_address" id="" class="form-control" placeholder="Invoice Address">{{ $indentedProposal->invoice_to_address != '' ? $indentedProposal->invoice_to_address : '' }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="ShitpTo" class="col-sm-2 control-label">Ship To:</label>
                     <div class="col-sm-5">
                        <input name="ship_to" disabled class="form-control" id="ShitpTo" placeholder="Ship To" value="{{ $indentedProposal->ship_to != '' ? $indentedProposal->ship_to : '' }}">
                        <br>
                        <textarea disabled name="ship_to_address" id="" class="form-control" placeholder="Ship To Address">{{ $indentedProposal->ship_to_address != '' ? $indentedProposal->ship_to_address : '' }}</textarea>
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
                              <b>NAME:&nbsp;</b> {{ $selectedItem->project_name != "" ? $selectedItem->project_name : ($selectedItem->after_market_name != '' ? $selectedItem->after_market_name : $selectedItem->seal_name) }}
                              <br>
                              <b>{{ $selectedItem->project_pn != "" ? "PN" : ($selectedItem->after_market_pn != '' ? "PN" : "BOM#") }} :&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ($selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number) }}
                              <br>
                              <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                              <br>
                              <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                              <br>
                              <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                           </td>
                           <td><input disabled type="text" class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_quantity }}"></td>
                           <td>
                              <div class="form-group{{ $errors->has('price.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input disabled type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->project_price != '' ? number_format($selectedItem->project_price, 2) : ($selectedItem->after_market_price != '' ? number_format($selectedItem->after_market_price, 2) : number_format($selectedItem->seal_price, 2)) }}">
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
                              <div class="form-group">
                                 <div class="col-lg-12">
                                    <div class="input-group">
                                       <input type="text" disabled class="form-control" name="delivery[{{ $selectedItem->indented_proposal_item_id }}]" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? ($selectedItem->delivery / 7) : ($selectedItem->delivery / 7) }}">
                                       <div class="input-group-addon">Weeks</div>
                                    </div>
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
                  <div class="form-group">
                     <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>SPECIAL INSTRUCTION</i></b>: </label>
                     <div class="col-sm-5">
                        <textarea disabled name="special_instruction" id="InputSpecialInstruction" class="form-control" placeholder="Special Instruction">{{ $indentedProposal->special_instructions != '' ? $indentedProposal->special_instructions : '' }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputShipVia" class="col-sm-2 control-label">SHIP VIA:</label>
                     <div class="col-sm-5">
                        <input name="ship_via" class="form-control" id="InputShipVia" disabled placeholder="Ship via" value="{{ $indentedProposal->ship_via != '' ? $indentedProposal->ship_via : '' }}">

                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputAmount" class="col-sm-2 control-label">AMOUNT:</label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="InputAmount" name="amount" placeholder="Amount" value="{{ $indentedProposal->amount != '' ? $indentedProposal->amount : '' }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputPacking" class="col-sm-2 control-label">PACKING:</label>
                     <div class="col-sm-5">
                        <textarea disabled name="packing" id="InputPacking" class="form-control" placeholder="Packing" >{{ $indentedProposal->packing != '' ? $indentedProposal->packing : '' }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputDocuments" class="col-sm-2 control-label">DOCUMENTS:</label>
                     <div class="col-sm-5">
                        <textarea disabled name="documents" id="InputDocuments" class="form-control" placeholder="Documents">{{ $indentedProposal->documents != '' ? $indentedProposal->documents : '' }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputInsurance" class="col-sm-2 control-label">INSURANCE:</label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="InputInsurance" name="insurance" placeholder="Insurance"  value="{{ $indentedProposal->insurance != '' ? $indentedProposal->insurance : '' }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputTermsOfPayment" class="col-sm-2 control-label">TERMS OF PAYMENT: </label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="InputTermsOfPayment" name="terms_of_payment_1" placeholder="Note"  value="{{ $indentedProposal->terms_of_payment_1 != '' ? $indentedProposal->terms_of_payment_1 : '' }}">
                        <br>
                        <textarea disabled name="terms_of_payment_address" id="InputTermsOfPayment2" class="form-control" placeholder="Address">{{ $indentedProposal->terms_of_payment_address != '' ? $indentedProposal->terms_of_payment_address : '' }}</textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputBankDetailName" class="col-sm-2 control-label">BANK DETAILS: </label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_owner" placeholder="Bank Details"  value="{{ $indentedProposal->bank_detail_name != '' ? $indentedProposal->bank_detail_name : '' }}">
                        <br>
                        <textarea disabled name="bank_detail_address" id="" class="form-control" placeholder="Bank Details Address">{{ $indentedProposal->bank_detail_address != '' ? $indentedProposal->bank_detail_address : '' }}</textarea>
                        <br>
                        <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_account_number" placeholder="Account Number"  value="{{ $indentedProposal->bank_detail_account_no != '' ? $indentedProposal->bank_detail_account_no : '' }}">
                        <br>
                        <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_swift_code" placeholder="Swift Code"  value="{{ $indentedProposal->bank_detail_swift_code != '' ? $indentedProposal->bank_detail_swift_code : '' }}">
                        <br>
                        <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_account_name" placeholder="Bank Account Name"  value="{{ $indentedProposal->bank_detail_account_name != '' ? $indentedProposal->bank_detail_account_name : '' }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="InputBankDetailName" class="col-sm-2 control-label">COMMISSION: </label>
                     <div class="col-sm-5">
                        <input class="form-control" disabled id="InputBankDetailName" name="commission_note" placeholder="Commission Details"  value="{{ $indentedProposal->commission_note != '' ? $indentedProposal->commission_note : '' }}">
                        <br>
                        <textarea disabled name="commission_address" id="" class="form-control" placeholder="Commission Address" >{{ $indentedProposal->commission_address != '' ? $indentedProposal->commission_address : '' }}</textarea>
                        <br>
                        <input class="form-control" disabled id="InputBankDetailName" name="commission_account_number" placeholder="Commission Account Number"  value="{{ $indentedProposal->commission_account_number != '' ? $indentedProposal->commission_account_number : '' }}">
                        <br>
                        <input class="form-control" disabled id="InputBankDetailName" name="commission_swift_code" placeholder="Commission Swift Code"  value="{{ $indentedProposal->commission_swift_code != '' ? $indentedProposal->commission_swift_code : '' }}">
                     </div>
                  </div>

               </div>
            </div>
         </form>
      </div>

   </div>
</div>
@stop
