<?php

namespace App\Http\Controllers\Assistant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\BuyAndSellProposal;
use App\IndentedProposalItem;
use App\BuyAndSellProposalItem;

class UserController extends Controller
{
    //
    public function dashboard()
    {
        $getIncomingItems_IndentedProposalItem = IndentedProposalItem::where('notification_date', '=', date('Y-m-d'))->get()->count();
        $getIncomingItems_BuyAndSellProposalItem = BuyAndSellProposalItem::where('notification_date', '=', date('Y-m-d'))->get()->count();


        $ctr = 0;
        $indented_proposals = IndentedProposal::where('collection_status', 'DELIVERY')->paginate(30);
        $indented_proposals->setPath('dashboard');

        $ctr2 = 0;
        $buy_and_sell_proposals = BuyAndSellProposal::where('collection_status', 'DELIVERY')->paginate(30);
        $buy_and_sell_proposals->setPath('dashboard');

        return view('auth.assistant.dashboard', compact('ctr', 'ctr2', 'indented_proposals', 'buy_and_sell_proposals', 'getIncomingItems_IndentedProposalItem',
            'getIncomingItems_BuyAndSellProposalItem'));
    }
}
