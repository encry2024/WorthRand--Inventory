<?php

namespace App\Http\Controllers\Admin;

use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserInformationRequest;
use App\Http\Requests\UpdateUserProfile;
use DB;

use App\TargetRevenue;
use App\TargetRevenueHistory;
use App\User;
use App\Customer;

class UserController extends Controller
{
   //
   public function adminDashboard()
   {
      $adminDashboard = User::adminDashboard();

      return $adminDashboard;
   }

   public function adminUserIndex()
   {
      $users = User::where('role', '!=', 'super_admin')->where('role', '!=', 'admin')->get();

      return view('user.admin.index', compact('users'));
   }

   public function adminCreateUser()
   {
      return view('user.admin.create');
   }

   public function adminPostUser(CreateUserRequest $createUserRequest)
   {
      $create_user = User::createUser($createUserRequest);

      return $create_user;
   }

   public function showSalesEngineers()
   {
      $users = User::whereRole('sales_engineer')->paginate(20);
      $users->setPath('/sales_engineer');

      return view('sales_engineer.admin.index', compact('users'));
   }

   public function showSalesEngineer(User $sales_engineer)
   {
      $targetRevenue = TargetRevenue::whereUserId($sales_engineer->id)->first();
      $customers = Customer::where('user_id', 0)->get();

      if(count($targetRevenue) != 0) {
         $targetRevenueHistory = DB::table('target_revenue_histories')
         ->select('target_revenue_histories.*', DB::raw('SUM(collected) as total_sales'))
         ->whereYear('date', '=', date('Y'))
         ->where('target_revenue_id', '=', $targetRevenue->id)
         ->groupBy(DB::raw("YEAR('date')"))
         ->first();
      }

      return view('sales_engineer.admin.show', compact('sales_engineer', 'targetRevenueHistory', 'customers'));
   }

   public function adminEditSalesEngineer(User $sales_engineer)
   {
      return view('sales_engineer.admin.edit', compact('sales_engineer'));
   }

   public function adminUpdateSalesEngineer(Request $request, UpdateUserInformationRequest $updateUserInformationRequest)
   {
      $user = User::find($request->get('user_id'));
      $user->update([
         'name' => ucwords($updateUserInformationRequest->get('name'), " "),
         'email' => $updateUserInformationRequest->get('email')
      ]);

      $target_revenue = new TargetRevenue();
      $target_revenue->user_id = $request->get('user_id');
      $target_revenue->target_sale = $request->get('target_sale');

      if($target_revenue->save()) {
         return redirect()->back()->with('message', 'You have successfully updates [ User :: ' . $user->name . ' ] Information');
      }
   }

   public function profile()
   {
      return view('auth.admin.profile');
   }

   public function updateProfile(UpdateUserProfile $updateUserProfile)
   {
      $adminUpdateProfile = User::adminUpdateProfile($updateUserProfile);

      return $adminUpdateProfile;
   }

   public function showUserProfile(User $user)
   {
      return view('user.admin.show', compact('user'));
   }

   public function adminEditUser(User $user)
   {
      return view('user.admin.edit', compact('user'));
   }

   public function updateUserProfile(Request $request, User $user)
   {
      $user->update(['name' => $request->get('name'), 'email' => $request->get('email')]);

      return redirect()->back()->with('message', 'User ' . $user->name . '\'s information was successfully updated');
   }

   public function adminResetPasswordUser(User $user)
   {
      $user->update(['password' => bcrypt('worthrand123')]);

      return redirect()->back()->with('message', 'Reset Password was successful');
   }

   public function adminSetTargetRevenue(Request $request, User $salesEngineer)
   {
      $setTargetRevenue = TargetRevenue::setTargetRevenue($request, $salesEngineer);

      return $setTargetRevenue;
   }

   public function deleteSalesEngineer(User $salesEngineer)
   {
      $salesEngineer->delete();

      return redirect()->back()->with('message', 'You have successfully delete Sales Engineer "' . $salesEngineer->name . '"');
   }

   public function deactivateSalesEngineer(User $salesEngineer)
   {
      $salesEngineer->update(['is_active' => 0]);

      return redirect()->back()->with('message', '' . $salesEngineer->name . '\'s account was successfully deactivated.');
   }

   public function activateSalesEngineer(User $salesEngineer)
   {
      $salesEngineer->update(['is_active' => 1]);

      return redirect()->back()->with('message', '' . $salesEngineer->name . '\'s account was successfully activated.');
   }
}
