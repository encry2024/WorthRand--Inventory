<?php

namespace App\Http\Controllers\SalesEngineer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UpdateUserProfile;

class UserController extends Controller
{
    public function dashboard()
    {
        $se_dashboard = User::salesEngineerDashboard();

        return $se_dashboard;
    }

    public function profile()
    {
        return view('auth.sales_engineer.profile');
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