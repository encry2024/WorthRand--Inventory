<?php

namespace App\Http\Controllers\Admin;

use App\TargetRevenue;
use App\TargetRevenueHistory;
use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserInformationRequest;
use App\Http\Requests\UpdateUserProfile;
use DB;

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
        $targetRevenueHistory = DB::table('target_revenue_histories')
            ->select('target_revenue_histories.*', DB::raw('SUM(collected) as total_sales'))
            ->whereYear('date', '=', date('Y'))
            ->where('target_revenue_id', '=', $targetRevenue->id)
            ->groupBy(DB::raw("YEAR('date')"))
            ->first();

        // dd($targetRevenueHistory);

        return view('sales_engineer.admin.show', compact('sales_engineer', 'targetRevenueHistory'));
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
}
