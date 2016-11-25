<?php

namespace App\Http\Controllers\Admin;

use App\TargetRevenue;
use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserInformationRequest;

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
        $users = User::whereRole('sales_engineer')->get();

        return view('sales_engineer.admin.index', compact('users'));
    }

    public function showSalesEngineer(User $sales_engineer)
    {
        return view('sales_engineer.admin.show', compact('sales_engineer'));
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
}
