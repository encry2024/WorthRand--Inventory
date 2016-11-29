@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">

            <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#indentedProposalFormConfirmation"><i class="fa fa-check"></i>&nbsp; Send Proposal</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('secretary_dashboard') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                </ul>
            </div>

            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                @if(Session::has('message'))
                    <div class="row">
                        <div class="alert {{ Session::get('alert') }} alert-dismissible" role="alert" style="margin-top: -1.05rem; border-radius: 0px 0px 0px 0px; font-size: 15px; margin-bottom: 1rem;">
                            <div class="container"><i class="{{ Session::get('msg_icon') }}"></i> {{ Session::get('message') }}
                                <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                        </div>
                    </div>
                @endif

                <form class="form-horizontal" action="{{ route('secretary_accept_indented_proposal', $indentedProposal->id) }}" method="POST" id="AcceptIndentedProposal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <input type="hidden" name="indent_proposal_id" value="{{ $indentedProposal->id }}">

                    <div class="row">
                        <div class="col-lg-12 col-lg-pull-1">
                            <div class="form-group">
                                <label for="collection_status" class="col-sm-2 control-label">Collection Status: </label>
                                <div class="col-sm-5">
                                    <input disabled class="form-control" id="collection_status" name="collection_status" placeholder="WPC Reference"
                                           value="{{ $indentedProposal->collection_status != '' ? $indentedProposal->collection_status : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="wpc_reference" class="col-sm-2 control-label">WPC Reference: </label>
                                <div class="col-sm-5">
                                    <input disabled class="form-control" id="wpc_reference" name="wpc_reference" placeholder="WPC Reference"
                                           value="{{ $indentedProposal->wpc_reference != '' ? $indentedProposal->wpc_reference : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <hr>
                    </div>

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
                                <label for="OfficeSold" class="col-sm-2 control-label">Sold To:</label>
                                <div class="col-sm-5">
                                    <input disabled name="sold_to" class="form-control" id="OfficeSold" placeholder="Sold To" value="{{ $indentedProposal->customer->name }}">
                                    <br>
                                    <textarea disabled name="sold_to_address" class="form-control" placeholder="Address">{{ $indentedProposal->customer->address }}</textarea>
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
                                        <td style="width: 13%;">{{ $selectedItem->project_mn != "" ? $selectedItem->project_mn : $selectedItem->after_market_mn }}</td>
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
                                        <td><input disabled type="text" class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_quantity }}"></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('price.'.$selectedItem->indented_proposal_item_id) ? ' has-error' : '' }}">
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        <input disabled type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}">
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
                                                        <input disabled type="text" class="form-control" name="delivery-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery / 7 : $selectedItem->delivery }}">
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

                    {{--<div class="form-group" style="font-size: 16px;">
                        <label for="exampleInputFile">File input</label>
                        <br>
                        <input type="file" id="exampleInputFile" name="fileField">
                        <p class="help-block">Upload File Here</p>
                    </div>--}}

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

                            {{-- <div class="form-group">
                                <label for="InputAmount" class="col-sm-2 control-label">AMOUNT:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="InputAmount" name="amount" placeholder="Amount" value="{{ $indentedProposal->amount != '' ? $indentedProposal->amount : '' }}">
                                </div>
                            </div> --}}

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

                            {{-- <div class="form-group">
                                <label for="InputTermsOfPayment" class="col-sm-2 control-label">TERMS OF PAYMENT: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="InputTermsOfPayment" name="terms_of_payment_1" placeholder="Note"  value="{{ $indentedProposal->terms_of_payment_1 != '' ? $indentedProposal->terms_of_payment_1 : '' }}">
                                    <br>
                                    <textarea name="terms_of_payment_address" id="InputTermsOfPayment2" class="form-control" placeholder="Address">{{ $indentedProposal->terms_of_payment_address != '' ? $indentedProposal->terms_of_payment_address : '' }}</textarea>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label for="InputBankDetailName" class="col-sm-2 control-label">BANK DETAILS: </label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="InputBankDetailName" name="bank_detail_owner" placeholder="Bank Details"  value="{{ $indentedProposal->bank_detail_name != '' ? $indentedProposal->bank_detail_name : '' }}">
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



<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="indentedProposalFormConfirmation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">You are about to accept this Indented Proposal</h4>
            </div>
            <div class="modal-body">
                <label for="">Are you sure you want to accept this Proposal <b>[ WPC Number: {{ $indentedProposal->wpc_reference }} ]</b> ?</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick='document.getElementById("AcceptIndentedProposal").submit();'>Accept</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@stop