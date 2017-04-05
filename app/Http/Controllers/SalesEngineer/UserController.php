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
      $seUpdateProfile = User::seUpdateProfile($updateUserProfile);

      return $seUpdateProfile;
   }
}
