<?php

namespace App\Http\Controllers\Admin;

use App\IndentedProposal;
use App\IndentedProposalItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use App\BuyAndSellProposal;
use App\Http\Controllers\Controller;

class ProposalController extends Controller
{

   public function adminIndentProposalView(IndentedProposal $indentedProposal)
   {
      $view_selected_items = IndentedProposal::viewIndentedProposal($indentedProposal);

      return $view_selected_items;
   }

   public function adminShowSentIndentedProposal(IndentedProposal $indented_proposal)
   {
      $showSentIndentedProposal = IndentedProposal::showSentIndentedProposal($indented_proposal);

      return $showSentIndentedProposal;
   }
   public function adminBuyAndSellProposalView(BuyAndSellProposal $buyAndSellProposal)
   {
      $view_selected_items = BuyAndSellProposal::viewBuyAndSellProposal($buyAndSellProposal);

      return $view_selected_items;
   }

   public function adminIndentedProposalIndex()
   {
      $ctr = 0;
      $indented_proposals = IndentedProposal::where('collection_status', '=', 'PENDING')->paginate(30);
      $indented_proposals->setPath('indented_proposals');

      return view('proposal.admin.indented_proposal.index', compact('indented_proposals', 'ctr'));
   }

   public function adminShowPendingIndentedProposal(IndentedProposal $indented_proposal)
   {
      $admin_show_pending_proposal = IndentedProposal::showPendingIndentedProposal($indented_proposal);

      return $admin_show_pending_proposal;
   }

   public function adminAcceptProposal(IndentedProposal $indented_proposal)
   {
      $indented_proposal = IndentedProposal::find($indented_proposal->id);
      $indented_proposal->update(['collection_status' => 'ACCEPTED']);

      return redirect()->back()->with('message', 'Indented Proposal [ WPC Number/Reference: #' . $indented_proposal->wpc_reference . ' ] Accepted')->with('alert', "alert-success");
   }

   public function adminShowPendingBuyAndSellProposal(BuyAndSellProposal $buy_and_sell_proposal)
   {
      $admin_show_pending_proposal = BuyAndSellProposal::showPendingBuyAndSellProposal($buy_and_sell_proposal);

      return $admin_show_pending_proposal;
   }

   public function adminBuyAndSellProposalIndex()
   {
      $buy_and_sell_proposals = BuyAndSellProposal::whereStatus('SENT')->get();

      return view('proposal.admin.buy_and_sell_proposal.index', compact('buy_and_sell_proposals'));
   }

   public function adminAcceptBuyAndSellProposal(BuyAndSellProposal $buyAndSellProposal)
   {
      $buyAndSellProposal->update(['collection_status' => 'ACCEPTED']);

      return redirect()->back()->with('message', 'Buy and Resale Proposal [ WPC Number/Reference: #' . $buyAndSellProposal->wpc_reference . ' ] Accepted')->with('alert', "alert-success");
   }

   public function adminCompletedIndentedProposal(IndentedProposal $indentedProposal)
   {
      $viewCompletedIndentedProposal = IndentedProposal::adminViewCompletedIndentedProposal($indentedProposal);

      return $viewCompletedIndentedProposal;
   }
}
