@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin_export_pending_bns_proposal', $buyAndSellProposal->id) }}" class="list-group-item"><i class="fa fa-download"></i>&nbsp; Export to XLSX</a>
                    <a class="list-group-item" href="{{ route('se_dashboard') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <form class="form-horizontal" action="{{ route('se_submit_buy_and_sell_proposal') }}" method="POST" id="SubmitBuyAndSellProposal">
                    {{ csrf_field() }}
                    <input type="hidden" name="buy_and_sell_proposal_id" value="{{ $buyAndSellProposal->id }}">
                    <input type="hidden" name="customer_id" id="customer_id">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                                <label for="wpc_reference" class="col-sm-2 control-label">WPC REFERENCE</label>
                                <div class="col-sm-5">
                                    <input disabled class="form-control" id="wpc_reference" name="wpc_reference" placeholder="Enter WPC Reference" value="{{ $buyAndSellProposal->wpc_reference }}">
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

                            <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
                                <label for="customer_field" class="col-sm-2 control-label">Customer:</label>
                                <div class="col-sm-5">
                                    <input disabled class="form-control" id="customer_field" name="sold" placeholder="Enter Customer Name" value="{{ $buyAndSellProposal->customer->name }}">
                                    @if ($errors->has('branch_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('branch_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-lg-push-2">
                                    <textarea disabled name="customer_address" id="customer_address" class="form-control" placeholder="Enter Customer Address">{{ $buyAndSellProposal->customer->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('invoice_to') ? ' has-error' : '' }}">
                                <label for="ShitpTo" class="col-sm-2 control-label">Invoice To:</label>
                                <div class="col-sm-5">
                                    <input disabled name="invoice_to" class="form-control" id="InvoiceTo" placeholder="Enter Invoice Reference/Number" value="{{ $buyAndSellProposal->invoice_to }}">
                                    @if ($errors->has('invoice_to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('invoice_to') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('invoice_address') ? ' has-error' : '' }}">
                                <div class="col-sm-5 col-lg-push-2">
                                    <textarea disabled name="invoice_address" id=invoice_address"" class="form-control" placeholder="Enter Invoice Address">{{ $buyAndSellProposal->invoice_address }}</textarea>
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
                                    <input disabled class="form-control" id="qrc_reference" name="qrc_reference" placeholder="Enter QRC Reference" value="{{ $buyAndSellProposal->qrc_ref }}">
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
                                            <b>{{ $selectedItem->project_pn != "" ? "PN" : ($selectedItem->after_market_pn != '' ? "PN" : "BOM#") }} :&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : ($selectedItem->after_market_pn != '' ? $selectedItem->after_market_pn : $selectedItem->seal_bom_number) }}
                                            <br>
                                            <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : ($selectedItem->after_market_md != '' ? $selectedItem->after_market_md : $selectedItem->seal_model) }}
                                            <br>
                                            <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : ($selectedItem->after_market_dn != '' ? $selectedItem->after_market_dn : $selectedItem->seal_drawing_number) }}
                                            <br>
                                            <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : ($selectedItem->after_market_tn != '' ? $selectedItem->after_market_tn : $selectedItem->seal_tag_number) }}
                                        </td>
                                        <td><input type="text" disabled class="form-control" name="quantity-{{ $selectedItem->buy_and_sell_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : '' }}"></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('price.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        <input disabled type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ number_format($selectedItem->buy_and_sell_proposal_item_price, 2) }}">
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
                                            <div class="form-group{{ $errors->has('delivery.'.$selectedItem->buy_and_sell_proposal_id) ? ' has-error' : '' }}">
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control" name="delivery-{{ $selectedItem->buy_and_sell_proposal_id }}" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery / 7 : $selectedItem->delivery }}">
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
                            <div class="form-group{{ $errors->has('validity') ? ' has-error' : '' }}">
                                <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>Validity:</i></b> </label>
                                <div class="col-sm-5">
                                    <input disabled name="validity" id="InputValidity" class="form-control" placeholder="Validity" value="{{ $buyAndSellProposal->validity }}"/>
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
                                    <input disabled class="form-control" id="InputPaymentTerms" name="terms" placeholder="Payment Terms" value="{{ $buyAndSellProposal->payment_terms }}" />
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
@stop