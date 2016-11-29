@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">

                <div class="sidebar col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                    <ul id="accordion" class="nav nav-pills nav-stacked sidebar-menu">
                        <li class="nav-item"><a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#indentedProposalFormConfirmation"><i class="fa fa-check"></i>&nbsp; Accept Proposal</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('assistant_dashboard') }}"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-sm-offset-3 main">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="alert {{ Session::get('alert') }} alert-dismissible" role="alert" style="margin-top: -1.05rem; border-radius: 0px 0px 0px 0px; font-size: 15px; margin-bottom: 1rem;">
                                <div class="container"><i class="glyphicon {{ Session::get('msg_icon') }}"></i>&nbsp;{{ Session::get('message') }}
                                    <button type="button" class="close" style="margin-right: 4rem;" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                            </div>
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('assistant_update_accepted_proposal', $indentedProposal->id) }}" method="POST" id="AcceptIndentedProposal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <input type="hidden" name="indent_proposal_id" value="{{ $indentedProposal->id }}">

                        <div class="row">
                            <div class="col-lg-12 col-lg-pull-1">
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
                                    <th>MATERIAL CODE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QUANTITY</th>
                                    <th>PRICE</th>
                                    <th>DELIVERY</th>
                                    <th>Notify me Aftr</th>
                                    <th>ACTIONS</th>
                                    </thead>

                                    <tbody>
                                    @foreach($selectedItems as $selectedItem)
                                        <tr>
                                            <td>{{ ++$ctr }}</td>
                                            <td style="width: 13%;">{{ $selectedItem->project_mn != "" ? $selectedItem->project_mn : $selectedItem->after_market_mn }}</td>
                                            <td style="width: 20%;">
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
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="text" disabled class="form-control" name="quantity-{{ $selectedItem->indented_proposal_item_id }}" placeholder="Enter item Quantity" value="{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_price }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">$</div>
                                                            <input type="text" disabled placeholder="Enter item price" class="form-control" name="price-{{ $selectedItem->indented_proposal_item_id }}" value="{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}">
                                                        </div>
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
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input disabled type="text" class="form-control" name="delivery[{{ $selectedItem->indented_proposal_item_id }}]" value="{{ $selectedItem->delivery != "" ? $selectedItem->notify_me_after / 7 : $selectedItem->notify_me_after / 7 }}">
                                                            <div class="input-group-addon">Weeks</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @if($selectedItem->status != "DELIVERED")
                                                <td style="width: 15%;">
                                                    <div class="dropdown">
                                                        <button class="btn {{ $selectedItem->status == "DELAYED" ? "btn-danger" : "btn-default" }} dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            {{ $selectedItem->status }}
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                            <li><a href="#delivered" data-toggle="modal" data-target="#changeItemDeliveryStatus" onclick="getDeliveredItem({{ $selectedItem->indented_proposal_item_id }});"><span class="glyphicon glyphicon-ok"></span> Delivered</a></li>
                                                            <li><a href="#update_notification" data-toggle="modal" data-target="#updateNotifyMeForm" onclick="getNotifyMe({{ $selectedItem->indented_proposal_item_id }});"><span class="glyphicon glyphicon-pushpin"></span> Notify Me</a></li>
                                                            <li><a href="#delayed" data-toggle="modal" data-target="#updateDeliveryStatusForm" onclick="getDeliveryStatus({{ $selectedItem->indented_proposal_item_id }});"><span class="glyphicon glyphicon-warning-sign"></span> Delayed</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @elseif($selectedItem->status == "DELIVERED")
                                                <td>
                                                    <label style="font-size: 14px;" class="label label-success">DELIVERED</label>
                                                </td>
                                            @endif
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
    </div>

    <form class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="indentedProposalFormConfirmation">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="indented_proposal_id" id="ipi_id">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WPC Number/Reference: {{ $indentedProposal->wpc_reference }}</h4>
                </div>
                <div class="modal-body">
                    <label for="">Are you sure you want to accept this Proposal <b>[ WPC Number/Reference: {{ $indentedProposal->wpc_reference }} ]</b> ?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick='document.getElementById("AcceptIndentedProposal").submit();'>Accept</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <form class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="changeItemDeliveryStatus" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="indented_proposal_id" id="ipi_id">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WPC Number/Reference: {{ $indentedProposal->wpc_reference }}</h4>
                </div>
                <div class="modal-body">
                    <label for="">You are about to change the delivery status of the selected item.</label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Accept</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <form class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="updateNotifyMeForm" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="indented_proposal_item_id" id="indentedProposalItemId">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Updating Notify Me Scheduled Date</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Notification Date:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <input type="text" class="form-control" name="notify_me_after">
                                <div class="input-group-addon">Weeks</div>
                            </div>
                        </div>
                    </div>
                    {{--You are about to changed the <label class="label label-info" style="color: black;">Notify Me After</label> of this item. The System will notify you about the delivery status of this item based on the number of weeks you set on the <label class="label label-info" style="color: black;">Notify Me After</label> column.--}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Notification Date</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <form class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="updateDeliveryStatusForm" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="indented_proposal_item_id" id="indentedProposalItemId">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Change Delivery Statys</h3>
                </div>
                <div class="modal-body">
                    <p>You are about to change the delivery status of this item to </p>
                    {{--You are about to changed the <label class="label label-info" style="color: black;">Notify Me After</label> of this item. The System will notify you about the delivery status of this item based on the number of weeks you set on the <label class="label label-info" style="color: black;">Notify Me After</label> column.--}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Delivery Status</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function getDeliveredItem(indented_proposal_item_id)
        {
            var deliverFormAction = "{{ route('change_indented_item_delivery_status', ':indented_proposal_item_id') }}";
                deliverFormAction = deliverFormAction.replace(':indented_proposal_item_id', indented_proposal_item_id);
            document.getElementById("ipi_id").value = indented_proposal_item_id;
            document.getElementById("changeItemDeliveryStatus").action = deliverFormAction;
        }

        function getNotifyMe(indented_proposal_item_id)
        {
            var deliverFormAction = "{{ route('change_indented_proposal_notify_me_date', ':indented_proposal_item_id') }}";
                deliverFormAction = deliverFormAction.replace(':indented_proposal_item_id', indented_proposal_item_id);
            document.getElementById("indentedProposalItemId").value = indented_proposal_item_id;
            document.getElementById("updateNotifyMeForm").action = deliverFormAction;
        }

        function getDeliveryStatus(indented_proposal_item_id)
        {
            var deliverFormAction = "{{ route('change_indented_proposal_delivery_status_to_delayed', ':indented_proposal_item_id') }}";
            deliverFormAction = deliverFormAction.replace(':indented_proposal_item_id', indented_proposal_item_id);
            document.getElementById("indentedProposalItemId").value = indented_proposal_item_id;
            document.getElementById("updateDeliveryStatusForm").action = deliverFormAction;
        }
    </script>
@stop