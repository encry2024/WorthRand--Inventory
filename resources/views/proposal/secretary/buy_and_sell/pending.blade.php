@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">

                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                        <li class="nav-item"><a class="nav-link" href="#send_proposal" onclick='document.getElementById("SubmitBuyAndSellProposal").submit();'><i class="fa fa-paper-plane"></i>&nbsp; Submit Proposal</a></li>

                        <li class="nav-item"><a class="nav-link"  href="{{ route('secretary_dashboard') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">

                    @if(Session::has('message'))
                        <div class="row">
                            <div class="alert {{ Session::get('alert') }} alert-dismissible" role="alert" style="background-color: {{ Session::get('bg-alert') }}; color: white; margin-top: -1.05rem; border-radius: 0px 0px 0px 0px; font-size: 15px; margin-bottom: 1rem;">
                                <div class="container"><i class="{{ Session::get('alert-icon') }}"></i>&nbsp;&nbsp;{{ Session::get('message') }}
                                    <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                            </div>
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('secretary_accept_buy_and_resale_proposal', $buyAndSellProposal->id) }}" method="POST" id="SubmitBuyAndSellProposal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <input type="hidden" name="buy_and_sell_proposal_id" value="{{ $buyAndSellProposal->id }}">

                        <div class="row">
                            <div class="col-lg-12 col-lg-pull-1">

                                <div class="form-group{{ $errors->has('purchase_order') ? ' has-error' : '' }}">
                                    <label for="purchase_order" class="col-sm-2 control-label">P.O</label>
                                    <div class="col-sm-5">
                                        <input {{ $buyAndSellProposal->purchase_order != '' ? 'disabled' : '' }} class="form-control" id="purchase_order" name="purchase_order" placeholder="Enter Purchase Order" value="{{ $buyAndSellProposal->purchase_order != '' ? $buyAndSellProposal->purchase_order : old('purchase_order') }}">
                                        @if ($errors->has('purchase_order'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('purchase_order') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

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
                                        <input disabled name="date" class="form-control" id="Date" placeholder="Date" value="{{ $buyAndSellProposal->date }}">
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
                                        <input class="form-control" id="qrc_reference" name="qrc_reference" placeholder="Enter QRC Reference" value="{{ $buyAndSellProposal->qrc_ref != '' ? $buyAndSellProposal->qrc_ref : old('qrc_reference') }}" {{ $buyAndSellProposal->payment_terms != '' ? "disabled" : "" }}>
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
                                            <td>
                                                <div class="form-group{{ $errors->has('quantity.'.$selectedItem->buy_and_sell_proposal_item_id) ? ' has-error' : '' }}">
                                                    <div class="col-lg-12">
                                                        <input disabled type="text" class="form-control" name="quantity[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_quantity }}" placeholder="Enter item Quantity">
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
                                                            <input disabled type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}">
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
                                                            <input disabled type="text" class="form-control" name="delivery[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" placeholder="Enter number of Weeks" value="{{ $selectedItem->delivery != "" ? $selectedItem->delivery / 7 : $selectedItem->after_market_delivery / 7 }}">
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
                                        <input name="validity" id="InputValidity" class="form-control" placeholder="Validity" value="{{ $buyAndSellProposal->validity != '' ? $buyAndSellProposal->validity : old('validity') }}" {{ $buyAndSellProposal->payment_terms != '' ? "disabled=false" : "disabled=true" }}/>
                                        @if ($errors->has('validity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('validity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('payment_terms') ? ' has-error' : '' }}">
                                    <label for="InputAmount" class="col-sm-2 control-label">Payment Terms:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputPaymentTerms" name="payment_terms" placeholder="Payment Terms" value="{{ $buyAndSellProposal->payment_terms != '' ? $buyAndSellProposal->payment_terms : old('payment_terms') }}" {{ $buyAndSellProposal->payment_terms != '' ? "disabled=false" : "disabled=true" }}>
                                        @if ($errors->has('payment_terms'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payment_terms') }}</strong>
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
    </div>
@stop