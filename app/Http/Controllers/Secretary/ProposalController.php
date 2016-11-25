<?php

namespace App\Http\Controllers\Secretary;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\Http\Requests\UpdateApprovedIndentedProposalBySecretary;
use App\BuyAndSellProposal;
use App\Http\Requests\UpdateApprovedBuyAndSellProposalBySecretary;

class ProposalController extends Controller
{
    //
    public function pendingIndentedProposal(IndentedProposal $indentedProposal)
    {
        $pendingIndentedProposal = IndentedProposal::secretaryPendingIndentedProposal($indentedProposal);

        return $pendingIndentedProposal;
    }

    public function acceptIndentedProposal(Request $request, UpdateApprovedIndentedProposalBySecretary $updateApprovedIndentedProposalBySecretary,
                                           IndentedProposal $indentedProposal)
    {
        $indentedProposal->update([
            'purchase_order' => $updateApprovedIndentedProposalBySecretary->get('purchase_order'),
            'invoice_to' => $updateApprovedIndentedProposalBySecretary->get('invoice'),
            'invoice_to_address' => ucwords($updateApprovedIndentedProposalBySecretary->get('invoice_address'), ' '),
            'ship_to' => ucwords($updateApprovedIndentedProposalBySecretary->get('ship_to'), ' '),
            'ship_to_address' => ucwords($updateApprovedIndentedProposalBySecretary->get('ship_to_address'), ' '),
            'special_instructions' => $request->get('special_instruction'),
            'ship_via' => $updateApprovedIndentedProposalBySecretary->get('ship_via'),
            'packing' => $updateApprovedIndentedProposalBySecretary->get('packing'),
            'documents' => ucfirst($updateApprovedIndentedProposalBySecretary->get('documents')),
            'insurance' => $updateApprovedIndentedProposalBySecretary->get('insurance'),
            'bank_detail_name' => ucwords($updateApprovedIndentedProposalBySecretary->get('bank_detail_owner'), ' '),
            'bank_detail_address' => ucwords($updateApprovedIndentedProposalBySecretary->get('bank_detail_address'), ' '),
            'bank_detail_account_no' => $updateApprovedIndentedProposalBySecretary->get('bank_detail_account_number'),
            'bank_detail_swift_code' => $updateApprovedIndentedProposalBySecretary->get('bank_detail_swift_code'),
            'bank_detail_account_name' => ucwords($updateApprovedIndentedProposalBySecretary->get('bank_detail_account_name'), ' '),
            'commission_note' => $updateApprovedIndentedProposalBySecretary->get('commission_note'),
            'commission_address' => ucwords($updateApprovedIndentedProposalBySecretary->get('commission_address'), ' '),
            'commission_account_number' => $updateApprovedIndentedProposalBySecretary->get('commission_account_number'),
            'commission_swift_code' => $updateApprovedIndentedProposalBySecretary->get('commission_swift_code'),
            'collection_status' => 'DELIVERY'
        ]);

        if(!$indentedProposal->update()) {
            return redirect()->back()
                ->with('msg_icon', 'glyphicon glyphicon-warning-sign')
                ->with('alert' , 'alert-danger')
                ->with('message', 'Please validate the input first before submitting again.');
        }

        return redirect()->back()
            ->with('msg_icon', 'glyphicon glyphicon-ok')
            ->with('alert' , 'alert-success')
            ->with('message', 'WPC Reference #' . $indentedProposal->wpc_reference . ' is now ready to proceed to the next process');
    }

    public function viewAcceptedBuyAndSellProposal(BuyAndSellProposal $buyAndSellProposal)
    {
        $secretary_show_accepted_buy_and_sell_proposal = BuyAndSellProposal::viewAcceptedBuyAndSellProposal($buyAndSellProposal);

        return $secretary_show_accepted_buy_and_sell_proposal;
    }

    public function acceptBuyAndResaleProposal(UpdateApprovedBuyAndSellProposalBySecretary $updateApprovedBuyAndSellProposalBySecretary,
                                               BuyAndSellProposal $buyAndSellProposal)
    {
        $buyAndSellProposal->update([
            'qrc_ref' => $updateApprovedBuyAndSellProposalBySecretary->get('qrc_reference'),
            'validity' => $updateApprovedBuyAndSellProposalBySecretary->get('validity'),
            'payment_terms' => $updateApprovedBuyAndSellProposalBySecretary->get('payment_terms'),
            'collection_status' => 'DELIVERY'
        ]);

        return redirect()->back()->with('alert', 'alert-success')
            ->with('alert-icon', 'glyphicon glyphicon-ok')
            ->with('bg-alert', '#5cb85c')
            ->with('message', 'Successfully accepted WPC #'.$buyAndSellProposal->wpc_reference.' Proposal.');
    }
}
