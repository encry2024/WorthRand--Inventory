@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <div class="row" style="margin-top: -2rem;">
            <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 0px; border-radius: 0px; color: #224323; background-color: #cde6cd;border-color: #bcddbc; background-image: none;">
                b<i class="fa fa-check" style="margin-left: 18rem;"></i>&nbsp;&nbsp;<b>{{ Session::get('message') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right: 15rem;"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    @endif
    <div class="col-lg-12">
        @if($indented_proposal->collection_status != "PENDING")
            <div class="alert alert-success" role="alert">
                <b><i class="fa fa-check"></i> This proposal is already in {{ strtoupper($indented_proposal->collection_status) }} status.</b>
            </div>
        @endif
        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('se_export_order_entry', $indented_proposal->id) }}" class="list-group-item"><i class="fa fa-download"></i>&nbsp; Export to XLSX</a>
                    <a class="list-group-item" href="{{ route('se_dashboard') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <form class="form-horizontal">

                    <input type="hidden" name="indent_proposal_id" value="{{ $indented_proposal->id }}">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <label style="font-size: 13px; font-weight: 800;"><i>Blank textboxes will be filled by Racquel after you accept this proposal</i></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-lg-pull-1">
                            <div class="form-group">
                                <label for="purchase_order" class="col-sm-2 control-label">P.O: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="purchase_order" name="purchase_order" placeholder="Purchase Order Number"
                                           value="{{ $indented_proposal->purchase_order != '' ? $indented_proposal->purchase_order : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="main_company" class="col-sm-2 control-label">To: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="main_company" name="to" placeholder="To" value="{{ $indented_proposal->customer->name }}" disabled>
                                    <br>
                                    <textarea disabled name="to_address" id="" class="form-control" placeholder="Address" disabled>{{ $indented_proposal->customer->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="OfficeSold" class="col-sm-2 control-label">Sold To:</label>
                                <div class="col-sm-5">
                                    <input name="sold_to" class="form-control" id="OfficeSold" placeholder="Sold To" value="{{ $indented_proposal->customer->name }}" disabled>
                                    <br>
                                    <textarea disabled name="sold_to_address" class="form-control" placeholder="Address" disabled>{{ $indented_proposal->customer->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputInvoice" class="col-sm-2 control-label">Invoice To:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="inputInvoice" name="invoice" placeholder="Enter Invoice" value="{{ $indented_proposal->invoice_to != '' ? $indented_proposal->invoice_to : '' }}">
                                    <br>
                                    <textarea disabled name="invoice_address" id="" class="form-control" placeholder="Invoice Address">{{ $indented_proposal->invoice_to_address != '' ? $indented_proposal->invoice_to_address : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ShitpTo" class="col-sm-2 control-label">Ship To:</label>
                                <div class="col-sm-5">
                                    <input disabled name="ship_to" class="form-control" id="ShitpTo" placeholder="Ship To" value="{{ $indented_proposal->ship_to != '' ? $indented_proposal->ship_to : '' }}">
                                    <br>
                                    <textarea disabled name="ship_to_address" id="" class="form-control" placeholder="Ship To Address">{{ $indented_proposal->ship_to_address != '' ? $indented_proposal->ship_to_address : '' }}</textarea>
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
                                <th>MATERIAL CODE</th>
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
                                            <b>{{ $selectedItem->project_pn != "" ? "PN" : ($selectedItem->after_market_pn != '' ? "PN" : "BOM#") }} :&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ($selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number) }}
                                            <br>
                                            <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                                            <br>
                                            <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                                            <br>
                                            <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                                        </td>
                                        <td><input type="text" disabled class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : '' }}"></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('price.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        <input type="text" disabled placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ number_format($selectedItem->indented_proposal_item_price, 2) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group{{ $errors->has('delivery.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control" name="delivery-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery / 7 : $selectedItem->delivery }}">
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

                    <div class="form-group" style="font-size: 16px;">
                        <label for="">Uploaded Purchase Order:</label>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('open_uploaded_po', $indented_proposal->id) }}">{{ $indented_proposal->file_name }}</a>
                    </div>

                    <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>SPECIAL INSTRUCTION</i></b>: </label>
                                <div class="col-sm-5">
                                    <textarea disabled name="special_instruction" id="InputSpecialInstruction" class="form-control" placeholder="Special Instruction">{{ $indented_proposal->special_instructions != '' ? $indented_proposal->special_instructions : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputShipVia" class="col-sm-2 control-label">SHIP VIA:</label>
                                <div class="col-sm-5">
                                    <input disabled name="ship_via" class="form-control" id="InputShipVia" placeholder="Ship via" value="{{ $indented_proposal->ship_via != '' ? $indented_proposal->ship_via : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputAmount" class="col-sm-2 control-label">AMOUNT:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="InputAmount" name="amount" placeholder="Amount" value="{{ $indented_proposal->amount != '' ? $indented_proposal->amount : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputPacking" class="col-sm-2 control-label">PACKING:</label>
                                <div class="col-sm-5">
                                    <textarea disabled name="packing" id="InputPacking" class="form-control" placeholder="Packing" >{{ $indented_proposal->packing != '' ? $indented_proposal->packing : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputDocuments" class="col-sm-2 control-label">DOCUMENTS:</label>
                                <div class="col-sm-5">
                                    <textarea disabled name="documents" id="InputDocuments" class="form-control" placeholder="Documents">{{ $indented_proposal->documents != '' ? $indented_proposal->documents : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputInsurance" class="col-sm-2 control-label">INSURANCE:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="InputInsurance" name="insurance" placeholder="Insurance"  value="{{ $indented_proposal->insurance != '' ? $indented_proposal->insurance : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputTermsOfPayment" class="col-sm-2 control-label">TERMS OF PAYMENT: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="InputTermsOfPayment" name="terms_of_payment_1" placeholder="Note"  value="{{ $indented_proposal->terms_of_payment_1 != '' ? $indented_proposal->terms_of_payment_1 : '' }}">
                                    <br>
                                    <textarea disabled name="terms_of_payment_address" id="InputTermsOfPayment2" class="form-control" placeholder="Address">{{ $indented_proposal->terms_of_payment_address != '' ? $indented_proposal->terms_of_payment_address : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputBankDetailName" class="col-sm-2 control-label">BANK DETAILS: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_owner" placeholder="Bank Details"  value="{{ $indented_proposal->bank_detail_name != '' ? $indented_proposal->bank_detail_name : '' }}">
                                    <br>
                                    <textarea disabled name="bank_detail_address" id="" class="form-control" placeholder="Bank Details Address">{{ $indented_proposal->bank_detail_address != '' ? $indented_proposal->bank_detail_address : '' }}</textarea>
                                    <br>
                                    <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_account_number" placeholder="Account Number"  value="{{ $indented_proposal->bank_detail_account_no != '' ? $indented_proposal->bank_detail_account_no : '' }}">
                                    <br>
                                    <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_swift_code" placeholder="Swift Code"  value="{{ $indented_proposal->bank_detail_swift_code != '' ? $indented_proposal->bank_detail_swift_code : '' }}">
                                    <br>
                                    <input class="form-control" disabled id="InputBankDetailName" name="bank_detail_account_name" placeholder="Bank Account Name"  value="{{ $indented_proposal->bank_detail_account_name != '' ? $indented_proposal->bank_detail_account_name : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="InputBankDetailName" class="col-sm-2 control-label">COMMISSION: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" disabled id="InputBankDetailName" name="commission_note" placeholder="Commission Details"  value="{{ $indented_proposal->commission_note != '' ? $indented_proposal->commission_note : '' }}">
                                    <br>
                                    <textarea disabled name="commission_address" id="" class="form-control" placeholder="Commission Address" >{{ $indented_proposal->commission_address != '' ? $indented_proposal->commission_address : '' }}</textarea>
                                    <br>
                                    <input class="form-control" disabled id="InputBankDetailName" name="commission_account_number" placeholder="Commission Account Number"  value="{{ $indented_proposal->commission_account_number != '' ? $indented_proposal->commission_account_number : '' }}">
                                    <br>
                                    <input class="form-control" disabled id="InputBankDetailName" name="commission_swift_code" placeholder="Commission Swift Code"  value="{{ $indented_proposal->commission_swift_code != '' ? $indented_proposal->commission_swift_code : '' }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@stop