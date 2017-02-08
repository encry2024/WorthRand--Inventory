<?php

namespace App\Http\Controllers\Secretary;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\BuyAndSellProposal;
use App\Http\Requests\UpdateUserProfile;
use App\User;
use Auth;
use App\BuyAndSellProposalItem;

class UserController extends Controller
{
    public function dashboard()
    {
        $ctr = 0;
        $indented_proposals = IndentedProposal::orderBy('created_at', 'desc')
            ->where('collection_status', '!=', 'ON-CREATE')
            ->simplePaginate(20, ['*'], 'indented_proposals');

        $ctr2 = 0;
        $buy_and_sell_proposals = BuyAndSellProposal::orderBy('created_at', 'desc')
            ->where('collection_status', '!=', 'ON-CREATE')
            ->simplePaginate(20, ['*'], 'buy_and_sell_proposals');

        return view('auth.secretary.dashboard', compact('ctr', 'indented_proposals', 'ctr2', 'buy_and_sell_proposals'));
    }

    public function profile()
    {
        return view('auth.secretary.profile');
    }

    public function updateProfile(UpdateUserProfile $updateUserProfile)
    {
        if($updateUserProfile->has('password')) {
            $user = User::find(Auth::user()->id);
            $user->name = ucwords($updateUserProfile->get('name'), ' ');
            $user->email = $updateUserProfile->get('email');
            $user->password = bcrypt($updateUserProfile->get('password'));

            if($user->save()) {
                return redirect()->back()
                    ->with('msg_icon', 'glyphicon glyphicon-ok')
                    ->with('message', 'You have successfully update your information')
                    ->with('alert', 'alert alert-success');
            }
        }

        $user = User::find(Auth::user()->id);
        $user->name = ucwords($updateUserProfile->get('name'), ' ');
        $user->email = $updateUserProfile->get('email');

        if($user->save()) {
            return redirect()->back()
                ->with('msg_icon', 'glyphicon glyphicon-ok')
                ->with('message', 'You have successfully update your information')
                ->with('alert', 'alert alert-success');
        }
    }
}
