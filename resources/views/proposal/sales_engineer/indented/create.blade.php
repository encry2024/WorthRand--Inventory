@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <div class="col-md-3">
            <div class="list-group">
                <a class="list-group-item" href="#send_proposal" onclick='document.getElementById("SubmitIndentedProposal").submit();' style="font-size: 13px;">
                    <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send Proposal
                </a>
                <a class="list-group-item" href="{{ route('se_dashboard') }}" onclick='document.getElementById("SubmitIndentedProposal").submit();' style="font-size: 13px;">
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

                <div class="row">
                    <div class="alert alert-info" role="alert">
                        <b><i class="fa fa-info-circle"></i> You have to put a <i>DASH "-"</i> on a field if you want to leave it blank.</b>
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
                            <label for="order_entry_no" class="col-sm-3 control-label">Order Entry Number: </label>
                            <div class="col-sm-5">
                                <input class="form-control" id="order_entry_no" name="order_entry_no" placeholder="Order Entry Number" value="{{ $indented_proposal->order_entry_no != '' ? $indented_proposal->order_entry_no : '' }}">
                            </div>
                        </div>

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
                                        {{ $selectedItem->project_name != "" ? $selectedItem->project_name : $selectedItem->after_market_name }}
                                        <br>
                                        <b>PN:&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : $selectedItem->after_market_pn }}
                                        <br>
                                        <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : $selectedItem->after_market_md }}
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
                                                    <input type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->project_price != '' ? number_format($selectedItem->project_price, 2) : number_format($selectedItem->after_market_price, 2) }}" id="itemPricing">
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

                <div class="row">
                    <hr>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="InputSpecialInstruction" class="col-sm-3 control-label"><b><i>SPECIAL INSTRUCTION</i></b>: </label>
                            <div class="col-sm-5">
                                <textarea name="special_instruction" id="InputSpecialInstruction" class="form-control" placeholder="Special Instruction">{{ $indented_proposal->special_instructions != '' ? $indented_proposal->special_instructions : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputShipVia" class="col-sm-3 control-label">SHIP VIA:</label>
                            <div class="col-sm-5">
                                <input name="ship_via" class="form-control" id="InputShipVia" placeholder="Ship via" value="{{ $indented_proposal->ship_via != '' ? $indented_proposal->ship_via : '' }}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputPacking" class="col-sm-3 control-label">PACKING:</label>
                            <div class="col-sm-5">
                                <textarea name="packing" id="InputPacking" class="form-control" placeholder="Packing" >{{ $indented_proposal->packing != '' ? $indented_proposal->packing : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputDocuments" class="col-sm-3 control-label">DOCUMENTS:</label>
                            <div class="col-sm-5">
                                <textarea name="documents" id="InputDocuments" class="form-control" placeholder="Documents">{{ $indented_proposal->documents != '' ? $indented_proposal->documents : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputInsurance" class="col-sm-3 control-label">INSURANCE:</label>
                            <div class="col-sm-5">
                                <input class="form-control" id="InputInsurance" name="insurance" placeholder="Insurance"  value="{{ $indented_proposal->insurance != '' ? $indented_proposal->insurance : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputBankDetailName" class="col-sm-3 control-label">BANK DETAILS: </label>
                            <div class="col-sm-5">
                                <input class="form-control" id="InputBankDetailName" name="bank_detail_owner" placeholder="Bank Details"  value="{{ $indented_proposal->bank_detail_name != '' ? $indented_proposal->bank_detail_name : '' }}">
                                <br>
                                <textarea name="bank_detail_address" id="" class="form-control" placeholder="Bank Details Address">{{ $indented_proposal->bank_detail_address != '' ? $indented_proposal->bank_detail_address : '' }}</textarea>
                                <br>
                                <input class="form-control" id="InputBankDetailName" name="bank_detail_account_number" placeholder="Account Number"  value="{{ $indented_proposal->bank_detail_account_no != '' ? $indented_proposal->bank_detail_account_no : '' }}">
                                <br>
                                <input class="form-control" id="InputBankDetailName" name="bank_detail_swift_code" placeholder="Swift Code"  value="{{ $indented_proposal->bank_detail_swift_code != '' ? $indented_proposal->bank_detail_swift_code : '' }}">
                                <br>
                                <input class="form-control" id="InputBankDetailName" name="bank_detail_account_name" placeholder="Bank Account Name"  value="{{ $indented_proposal->bank_detail_account_name != '' ? $indented_proposal->bank_detail_account_name : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputBankDetailName" class="col-sm-3 control-label">COMMISSION: </label>
                            <div class="col-sm-5">
                                <input class="form-control" id="InputBankDetailName" name="commission_note" placeholder="Commission Details"  value="{{ $indented_proposal->commission_note != '' ? $indented_proposal->commission_note : '' }}">
                                <br>
                                <textarea name="commission_address" id="" class="form-control" placeholder="Commission Address" >{{ $indented_proposal->commission_address != '' ? $indented_proposal->commission_address : '' }}</textarea>
                                <br>
                                <input class="form-control" id="InputBankDetailName" name="commission_account_number" placeholder="Commission Account Number"  value="{{ $indented_proposal->commission_account_number != '' ? $indented_proposal->commission_account_number : '' }}">
                                <br>
                                <input class="form-control" id="InputBankDetailName" name="commission_swift_code" placeholder="Commission Swift Code"  value="{{ $indented_proposal->commission_swift_code != '' ? $indented_proposal->commission_swift_code : '' }}">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var data;
            $('#branch_field').autocomplete({
                serviceUrl: "{{ URL::to('/') }}/{{ Auth::user()->role }}/fetch_customers/",
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