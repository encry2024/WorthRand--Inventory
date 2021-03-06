@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">

            <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                    <li class="nav-item"><a class="nav-link" href="#send_proposal" onclick='document.getElementById("SubmitBuyAndSellProposal").submit();'><i class="fa fa-paper-plane"></i>&nbsp; Submit Proposal</a></li>

                    <li class="nav-item"><a class="nav-link"  href="{{ route('search') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                </ul>
            </div>

            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                <form class="form-horizontal" action="{{ route('se_submit_buy_and_sell_proposal') }}" method="POST" id="SubmitBuyAndSellProposal">
                    {{ csrf_field() }}
                    <input type="hidden" name="buy_and_sell_proposal_id" value="{{ $buyAndSellProposal->id }}">
                    <input type="hidden" name="customer_id" id="customer_id">

                    <div class="row">
                        <div class="col-lg-12 col-lg-pull-1">

                            <div class="form-group{{ $errors->has('wpc_reference') ? ' has-error' : '' }}">
                                <label for="wpc_reference" class="col-sm-2 control-label">WPC REFERENCE</label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="wpc_reference" name="wpc_reference" placeholder="Enter WPC Reference" value="{{ old('wpc_reference') }}">
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
                                    <input class="form-control" id="customer_field" name="sold" placeholder="Enter Customer Name">
                                    @if ($errors->has('branch_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('branch_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-lg-push-2">
                                    <textarea name="customer_address" id="customer_address" class="form-control" placeholder="Enter Customer Address"></textarea>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('invoice_to') ? ' has-error' : '' }}">
                                <label for="ShitpTo" class="col-sm-2 control-label">Invoice To:</label>
                                <div class="col-sm-5">
                                    <input name="invoice_to" class="form-control" id="InvoiceTo" placeholder="Enter Invoice Reference/Number">
                                    @if ($errors->has('invoice_to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('invoice_to') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('invoice_address') ? ' has-error' : '' }}">
                                <div class="col-sm-5 col-lg-push-2">
                                    <textarea name="invoice_address" id=invoice_address"" class="form-control" placeholder="Enter Invoice Address"></textarea>
                                    @if ($errors->has('invoice_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('invoice_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group{{ $errors->has('qrc_reference') ? ' has-error' : '' }}">
                                <label for="qrc_reference" class="col-sm-2 control-label">QRC REFERENCE</label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="qrc_reference" name="qrc_reference" placeholder="Enter QRC Reference">
                                    @if ($errors->has('qrc_reference'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('qrc_reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>--}}
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
                                                        <input type="text" placeholder="Enter item price" class="form-control" name="price[{{ $selectedItem->buy_and_sell_proposal_item_id }}]" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}">
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

                    {{--<div class="row">
                        <div class="col-lg-12">
                            div class="form-group{{ $errors->has('validity') ? ' has-error' : '' }}">
                                <label for="InputSpecialInstruction" class="col-sm-2 control-label"><b><i>Validity:</i></b> </label>
                                <div class="col-sm-5">
                                    <input name="validity" id="InputValidity" class="form-control" placeholder="Validity"/>
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
                                    <input class="form-control" id="InputPaymentTerms" name="terms" placeholder="Payment Terms">
                                    @if ($errors->has('terms'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#customer_field').autocomplete({
                serviceUrl: "{{ URL::to('/') }}/{{ Auth::user()->role }}/fetch_customers/",
                dataType: 'json',
                type: 'get',
                onSelect: function (suggestions) {
                    document.getElementById('customer_address').value = suggestions.address;
                    document.getElementById('customer_id').value = suggestions.id;
                }
            });
        });
    </script>
@stop