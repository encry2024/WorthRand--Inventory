@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">

                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                        <li class="nav-item"><a class="nav-link"  href="{{ route('search') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    <form class="form-horizontal" action="{{ route('se_submit_indented_proposal') }}" method="POST" id="SubmitIndentedProposal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="indent_proposal_id" value="{{ $indentedProposal->id }}">

                        <div class="row">
                            <div class="col-lg-12 col-lg-pull-1">
                                <div class="form-group">
                                    <label for="purchase_order" class="col-sm-2 control-label">P.O: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="purchase_order" name="purchase_order" placeholder="Purchase Order Number"
                                               value="{{ $indentedProposal->purchase_order != '' ? $indentedProposal->purchase_order : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="main_company" class="col-sm-2 control-label">To: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="main_company" name="to" placeholder="To" value="{{ $indentedProposal->customer_id != '' ? $indentedProposal->customer->name : '' }}">
                                        <br>
                                        <textarea name="to_address" id="" class="form-control" placeholder="Address">{{ $indentedProposal->customer_id != '' ? $indentedProposal->customer->address : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="OfficeSold" class="col-sm-2 control-label">Sold To:</label>
                                    <div class="col-sm-5">
                                        <input name="sold_to" class="form-control" id="OfficeSold" placeholder="Sold To" value="{{ $indentedProposal->branch_id != '' ? $indentedProposal->branch->name : '' }}">
                                        <br>
                                        <textarea name="sold_to_address" class="form-control" placeholder="Address"> {{ $indentedProposal->branch_id != '' ? $indentedProposal->branch->address : '' }} </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputInvoice" class="col-sm-2 control-label">Invoice To:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="inputInvoice" name="invoice" placeholder="Enter Invoice" value="{{ $indentedProposal->invoice_to != '' ? $indentedProposal->invoice_to : '' }}">
                                        <br>
                                        <textarea name="invoice_address" id="" class="form-control" placeholder="Invoice Address">{{ $indentedProposal->invoice_to_address != '' ? $indentedProposal->invoice_to_address : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ShitpTo" class="col-sm-2 control-label">Ship To:</label>
                                    <div class="col-sm-5">
                                        <input name="ship_to" class="form-control" id="ShitpTo" placeholder="Ship To" value="{{ $indentedProposal->ship_to != '' ? $indentedProposal->ship_to : '' }}">
                                        <br>
                                        <textarea name="ship_to_address" id="" class="form-control" placeholder="Ship To Address">{{ $indentedProposal->ship_to_address != '' ? $indentedProposal->ship_to_address : '' }}</textarea>
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
                                                <b>NAME:&nbsp;</b> {{ $selectedItem->project_name != "" ? $selectedItem->project_name : $selectedItem->after_market_name }}
                                                <br>
                                                <b>PN:&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : $selectedItem->after_market_pn }}
                                                <br>
                                                <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : $selectedItem->after_market_md }}
                                                <br>
                                                <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : $selectedItem->after_market_dn }}
                                                <br>
                                                <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : $selectedItem->after_market_tn }}
                                            </td>
                                            <td><input type="text" class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_price }}"></td>
                                            <td><input type="text" placeholder="Enter item price" class="form-control" name="price-{{ $selectedItem->indented_proposal_item_id }}" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}"></td>
                                            <td class="">
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="delivery-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery : $selectedItem->delivery }}">
                                                        <div class="input-group-addon">Weeks</div>
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
                            <label for="exampleInputFile">File input</label>
                            <br>
                            <input type="file" id="exampleInputFile" name="fileField">
                            <p class="help-block">Upload File Here</p>
                        </div>

                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>SPECIAL INSTRUCTION</i></b>: </label>
                                    <div class="col-sm-5">
                                        <textarea name="special_instruction" id="InputSpecialInstruction" class="form-control" placeholder="Special Instruction">{{ $indentedProposal->special_instructions != '' ? $indentedProposal->special_instructions : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputShipVia" class="col-sm-2 control-label">SHIP VIA:</label>
                                    <div class="col-sm-5">
                                        <input name="ship_via" class="form-control" id="InputShipVia" placeholder="Ship via" value="{{ $indentedProposal->ship_via != '' ? $indentedProposal->ship_via : '' }}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputAmount" class="col-sm-2 control-label">AMOUNT:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputAmount" name="amount" placeholder="Amount" value="{{ $indentedProposal->amount != '' ? $indentedProposal->amount : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputPacking" class="col-sm-2 control-label">PACKING:</label>
                                    <div class="col-sm-5">
                                        <textarea name="packing" id="InputPacking" class="form-control" placeholder="Packing" >{{ $indentedProposal->packing != '' ? $indentedProposal->packing : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputDocuments" class="col-sm-2 control-label">DOCUMENTS:</label>
                                    <div class="col-sm-5">
                                        <textarea name="documents" id="InputDocuments" class="form-control" placeholder="Documents">{{ $indentedProposal->documents != '' ? $indentedProposal->documents : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputInsurance" class="col-sm-2 control-label">INSURANCE:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputInsurance" name="insurance" placeholder="Insurance"  value="{{ $indentedProposal->insurance != '' ? $indentedProposal->insurance : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputTermsOfPayment" class="col-sm-2 control-label">TERMS OF PAYMENT: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputTermsOfPayment" name="terms_of_payment_1" placeholder="Note"  value="{{ $indentedProposal->terms_of_payment_1 != '' ? $indentedProposal->terms_of_payment_1 : '' }}">
                                        <br>
                                        <textarea name="terms_of_payment_address" id="InputTermsOfPayment2" class="form-control" placeholder="Address">{{ $indentedProposal->terms_of_payment_address != '' ? $indentedProposal->terms_of_payment_address : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputBankDetailName" class="col-sm-2 control-label">BANK DETAILS: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_owner" placeholder="Bank Details"  value="{{ $indentedProposal->bank_detail_owner != '' ? $indentedProposal->bank_detail_owner : '' }}">
                                        <br>
                                        <textarea name="bank_detail_address" id="" class="form-control" placeholder="Bank Details Address">{{ $indentedProposal->bank_detail_address != '' ? $indentedProposal->bank_detail_address : '' }}</textarea>
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_account_number" placeholder="Account Number"  value="{{ $indentedProposal->bank_detail_account_no != '' ? $indentedProposal->bank_detail_account_no : '' }}">
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_swift_code" placeholder="Swift Code"  value="{{ $indentedProposal->bank_detail_swift_code != '' ? $indentedProposal->bank_detail_swift_code : '' }}">
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_account_name" placeholder="Bank Account Name"  value="{{ $indentedProposal->bank_detail_account_name != '' ? $indentedProposal->bank_detail_account_name : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputBankDetailName" class="col-sm-2 control-label">COMMISSION: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputBankDetailName" name="commission_note" placeholder="Commission Details"  value="{{ $indentedProposal->commission_note != '' ? $indentedProposal->commission_note : '' }}">
                                        <br>
                                        <textarea name="commission_address" id="" class="form-control" placeholder="Commission Address" >{{ $indentedProposal->commission_address != '' ? $indentedProposal->commission_address : '' }}</textarea>
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="commission_account_number" placeholder="Commission Account Number"  value="{{ $indentedProposal->commission_account_number != '' ? $indentedProposal->commission_account_number : '' }}">
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="commission_swift_code" placeholder="Commission Swift Code"  value="{{ $indentedProposal->commission_swift_code != '' ? $indentedProposal->commission_swift_code : '' }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop