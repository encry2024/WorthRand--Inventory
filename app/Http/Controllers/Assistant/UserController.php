<?php

namespace App\Http\Controllers\Assistant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use App\BuyAndSellProposal;
use App\IndentedProposalItem;
use App\BuyAndSellProposalItem;
use App\Http\Requests\UpdateUserProfile;
use App\User;
use Auth;

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

   public function profile()
   {
      return view('auth.assistant.profile');
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
