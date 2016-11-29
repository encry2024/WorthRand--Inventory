<?php

namespace App\Http\Controllers\Assistant;

use App\IndentedProposal;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\BuyAndSellProposal;
use App\IndentedProposalItem;
use App\BuyAndSellProposalItem;

class ProposalController extends Controller
{
    //
    public function showAcceptedIndentedProposal(IndentedProposal $indentedProposal)
    {
        $show_accepted_proposal = IndentedProposal::showAcceptedIndentedProposal($indentedProposal);

        return $show_accepted_proposal;
    }

    public function updateIndentedProposal(IndentedProposal $indentedProposal)
    {
        $update_accepted_proposal = IndentedProposal::find($indentedProposal->id);
        $update_accepted_proposal->update(['collection_status' => 'FOR-COLLECTION']);

        return redirect()->back()->with('message', 'Indented Proposal [ Purchase Order Number: #' . $indentedProposal->purchase_order . ' ] is now ready for collection')
            ->with('alert', 'alert-success');
    }

    public function assistantShowPendingBuyAndSellProposal(BuyAndSellProposal $buyAndSellProposal)
    {
        $admin_show_pending_proposal = BuyAndSellProposal::showAssistantPendingBuyAndSellProposal($buyAndSellProposal);

        return $admin_show_pending_proposal;
    }

    public function changeItemDeliveryStatus(IndentedProposalItem $indentedProposalItem)
    {
        $indentedProposalItem->update(['status' => 'DELIVERED']);

        return redirect()->back()
            ->with('alert', 'alert-success')
            ->with('msg_icon', 'glyphicon-ok')
            ->with('message', 'Item process status was changed to Delivered');
    }

    public function buyAndSellProposalChangeItemStatus(BuyAndSellProposalItem $buyAndSellProposalItem)
    {
        $buyAndSellProposalItem->update(['status' => 'DELIVERED']);

        return redirect()->back()
            ->with('alert', 'alert-success')
            ->with('msg_icon', 'glyphicon-ok')
            ->with('message', 'Item process status was changed to Delivered');
    }

    public function buyAndSellProposalChangeItemNotifyMeDate(Request $request, BuyAndSellProposalItem $buyAndSellProposalItem)
    {
        $buyAndSellProposalChangeNotificationDate = BuyAndSellProposalItem::buyAndSellProposalChangeItemNotifyMeDate($request, $buyAndSellProposalItem);

        return $buyAndSellProposalChangeNotificationDate;
    }

    public function indentedProposalChangeItemNotifyMeDate(Request $request, IndentedProposalItem $indentedProposalItem)
    {
        $indentedProposalChangeNotificationDate = IndentedProposalItem::indentedProposalChangeItemNotifyMeDate($request, $indentedProposalItem);

        return $indentedProposalChangeNotificationDate;
    }

    public function indentedProposalChangeDeliveryStatusToDelayed(IndentedProposalItem $indentedProposalItem)
    {
        $indentedProposalItem->update(['status' => 'DELAYED']);

        return redirect()->back()
            ->with('alert', 'alert-success')
            ->with('msg_icon', 'glyphicon-ok')
            ->with('message', 'Item process status was changed to Delayed');
    }

    public function buyAndSellProposalChangeDeliveryStatusToDelayed(BuyAndSellProposalItem $buyAndSellProposalItem)
    {
        $buyAndSellProposalItem->update(['status' => 'DELAYED']);

        return redirect()->back()
            ->with('alert', 'alert-success')
            ->with('msg_icon', 'glyphicon-ok')
            ->with('message', 'Item process status was changed to Delayed');
    }
}
