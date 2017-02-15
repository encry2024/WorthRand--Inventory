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
            'invoice_to' => strtoupper($updateApprovedIndentedProposalBySecretary->get('invoice_to')),
            'invoice_to_address' => strtoupper($updateApprovedIndentedProposalBySecretary->get('invoice_to_address')),
            /*'ship_to' => strtoupper($updateApprovedIndentedProposalBySecretary->get('ship_to')),
            'ship_to_address' => strtoupper($updateApprovedIndentedProposalBySecretary->get('ship_to_address')),*/
            'special_instructions' => strtoupper($request->get('special_instruction')),
            /*'ship_via' => strtoupper($updateApprovedIndentedProposalBySecretary->get('ship_via')),
            'packing' => strtoupper($updateApprovedIndentedProposalBySecretary->get('packing')),
            'documents' => strtoupper($updateApprovedIndentedProposalBySecretary->get('documents')),
            'insurance' => strtoupper($updateApprovedIndentedProposalBySecretary->get('insurance')),
            'bank_detail_name' => strtoupper($updateApprovedIndentedProposalBySecretary->get('bank_detail_owner')),
            'bank_detail_address' => strtoupper($updateApprovedIndentedProposalBySecretary->get('bank_detail_address')),*/
            'bank_detail_account_no' => strtoupper($updateApprovedIndentedProposalBySecretary->get('bank_detail_account_number')),
            /*'bank_detail_swift_code' => strtoupper($updateApprovedIndentedProposalBySecretary->get('bank_detail_swift_code')),
            'bank_detail_account_name' => strtoupper($updateApprovedIndentedProposalBySecretary->get('bank_detail_account_name')),
            'commission_note' => strtoupper($updateApprovedIndentedProposalBySecretary->get('commission_note')),
            'commission_address' => strtoupper($updateApprovedIndentedProposalBySecretary->get('commission_address')),
            'commission_account_number' => strtoupper($updateApprovedIndentedProposalBySecretary->get('commission_account_number')),
            'commission_swift_code' => strtoupper($updateApprovedIndentedProposalBySecretary->get('commission_swift_code')),*/
            'collection_status' => 'DELIVERY'
        ]);

        if(!$indentedProposal->update()) {
            return redirect()->back()
                ->with('msg_icon', 'fa fa-exclamation-triangle')
                ->with('alert' , 'alert-danger')
                ->with('message', 'Please validate the input first before submitting again.');
        }

        return redirect()->back()
            ->with('msg_icon', 'fa fa-check')
            ->with('alert' , 'alert-success')
            ->with('message', 'WPC Reference #' . strtoupper($indentedProposal->wpc_reference) . ' is now ready to proceed to DELIVERY process');
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
