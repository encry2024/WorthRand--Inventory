<?php

namespace App\Http\Controllers\Collection;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\BuyAndSellProposal;

class UserController extends Controller
{
    public function collectionDashboard()
    {
        $ctr = 0;
        $indented_proposals = IndentedProposal::orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'indented_proposals');

        $ctr2 = 0;
        $buy_and_sell_proposals = BuyAndSellProposal::orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'buy_and_sell_proposals');

        return view('auth.collection.dashboard', compact('indented_proposals', 'buy_and_sell_proposals', 'ctr', 'ctr2'));
    }
}
