<?php

namespace App\Http\Controllers\SalesEngineer;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\Http\Requests\CreateIndentedProposalRequest;
use App\IndentedProposalItem;
use App\BuyAndSellProposal;
use App\BuyAndSellProposalItem;
use App\Http\Requests\CreateBuyAndSellProposalRequest;
use App\Http\Requests\ResendDraftIndentedProposal;

class ProposalController extends Controller
{
   //
   public function salesEngineerPostCreateIndentedProposal(Request $request)
   {
      $create_indented_proposal = IndentedProposal::salesEngineerPostCreateIndentedProposal($request);

      return $create_indented_proposal;
   }

   public function salesEngineerSubmitIndentedProposal(CreateIndentedProposalRequest $createIndentedProposalRequest)
   {
      $saveIndentedProposal = IndentedProposal::saveIndentedProposal($createIndentedProposalRequest);

      return $saveIndentedProposal;
   }

   public function resendDraftIndentedProposal(ResendDraftIndentedProposal $resendIndentedProposalRequest, IndentedProposal $indentedProposal)
   {
      $saveIndentedProposal = IndentedProposal::resendDraftIndentedProposal($resendIndentedProposalRequest);

      return $saveIndentedProposal;
   }

   public function salesEngineerIndentProposalView(IndentedProposal $indentedProposal)
   {
      $view_selected_items = IndentedProposal::showCreateIndentedProposal($indentedProposal);

      return $view_selected_items;
   }

   public function salesEngineerPostCreateBuyAndSellProposal(Request $request)
   {
      $create_buy_and_sell_proposal = BuyAndSellProposal::salesEngineerPostCreateBuyAndSellProposal($request);

      return $create_buy_and_sell_proposal;
   }

   public function salesEngineerBuyAndSellProposalView(BuyAndSellProposal $buyAndSellProposal)
   {
      $view_selected_items = BuyAndSellProposal::viewBuyAndSellProposal($buyAndSellProposal);

      return $view_selected_items;
   }

   public function salesEngineerSubmitBuyAndSellProposal(CreateBuyAndSellProposalRequest $createBuyAndSellProposalRequest)
   {
      $saveBuyAndSellProposal = BuyAndSellProposal::saveBuyAndSellProposal($createBuyAndSellProposalRequest);

      return $saveBuyAndSellProposal;
   }

   public function showSentIndentedProposal(IndentedProposal $indentedProposal)
   {
      $view_sent_indented_proposal = IndentedProposal::viewSentIndentedProposal($indentedProposal);

      return $view_sent_indented_proposal;
   }

   public function showDraftIndentedProposal(IndentedProposal $indentedProposal)
   {
      $showDraftIndentedProposal = IndentedProposal::showDraftIndentedProposal($indentedProposal);

      return $showDraftIndentedProposal;
   }

   public function showDraftBuyAndResaleProposal(BuyAndSellProposal $buyAndSellProposal)
   {
      $showDraftBuyAndResaleProposal = BuyAndSellProposal::draftBuyAndResaleProposal($buyAndSellProposal);

      return $showDraftBuyAndResaleProposal;
   }

   public function showSentBuyAndResaleProposal(BuyAndSellProposal $buyAndSellProposal)
   {
      $view_sent_buy_and_sell = BuyAndSellProposal::viewSentBuyAndSellProposal($buyAndSellProposal);

      return $view_sent_buy_and_sell;
   }
}
