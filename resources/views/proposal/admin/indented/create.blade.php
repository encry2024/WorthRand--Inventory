@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">

                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                        <li class="nav-item"><a class="nav-link" href="#send_proposal" onclick='document.getElementById("SubmitIndentedProposal").submit();'><i class="fa fa-paper-plane"></i>&nbsp; Submit Proposal</a></li>

                        <li class="nav-item"><a class="nav-link"  href="{{ route('admin_create_proposal') }}"><i class="fa fa-arrow-left"></i>&nbsp; back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    <form class="form-horizontal" action="{{ route('admin_submit_indented_proposal') }}" method="POST" id="SubmitIndentedProposal">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-12 col-lg-pull-1">
                                <div class="form-group">
                                    <label for="main_company" class="col-sm-2 control-label">To: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="main_company" name="main_office" placeholder="To">
                                        <br>
                                        <textarea name="main_address" id="" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="OfficeSold" class="col-sm-2 control-label">Sold To:</label>
                                    <div class="col-sm-5">
                                        <input name="office_sold" class="form-control" id="OfficeSold" placeholder="Sold To">
                                        <br>
                                        <textarea name="office_address" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputInvoice" class="col-sm-2 control-label">Invoice To:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="inputInvoice" name="invoice" placeholder="Enter Invoice">
                                        <br>
                                        <textarea name="invoice_address" id="" class="form-control" placeholder="Invoice Address"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ShitpTo" class="col-sm-2 control-label">Ship To:</label>
                                    <div class="col-sm-5">
                                        <input name="ship_to" class="form-control" id="ShitpTo" placeholder="Ship To">
                                        <br>
                                        <textarea name="ship_to_address" id="" class="form-control" placeholder="Ship To Address"></textarea>
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
                                            <td><input type="text" class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity"></td>
                                            <td><input type="text" placeholder="Enter item price" class="form-control" name="price-{{ $selectedItem->indented_proposal_item_id }}" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}"></td>
                                            <td>
                                                <input type="text" class="form-control" name="delivery-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter number of Weeks">
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
                                        <textarea name="special_instruction" id="InputSpecialInstruction" class="form-control" placeholder="Special Instruction"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputShipVia" class="col-sm-2 control-label">SHIP VIA:</label>
                                    <div class="col-sm-5">
                                        <input name="ship_via" class="form-control" id="InputShipVia" placeholder="Ship via">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputAmount" class="col-sm-2 control-label">AMOUNT:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputAmount" name="amount" placeholder="Amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputPacking" class="col-sm-2 control-label">PACKING:</label>
                                    <div class="col-sm-5">
                                        <textarea name="packing" id="InputPacking" class="form-control" placeholder="Packing"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputDocuments" class="col-sm-2 control-label">DOCUMENTS:</label>
                                    <div class="col-sm-5">
                                        <textarea name="documents" id="InputDocuments" class="form-control" placeholder="Documents"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputInsurance" class="col-sm-2 control-label">INSURANCE:</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputInsurance" name="amount" placeholder="Amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputTermsOfPayment" class="col-sm-2 control-label">TERMS OF PAYMENT: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputTermsOfPayment" name="terms_of_payment_1" placeholder="Note">
                                        <br>
                                        <textarea name="terms_of_payment_address" id="InputTermsOfPayment2" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputBankDetailName" class="col-sm-2 control-label">BANK DETAILS: </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_name" placeholder="Bank Details">
                                        <br>
                                        <textarea name="terms_of_payment_address" id="" class="form-control" placeholder="Bank Details Address"></textarea>
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_account_number" placeholder="Account Number">
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_swift_code" placeholder="Swift Code">
                                        <br>
                                        <input class="form-control" id="InputBankDetailName" name="bank_detail_account_name" placeholder="Account Name">
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