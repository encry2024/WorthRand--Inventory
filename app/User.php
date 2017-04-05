<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\IndentedProposal;
use App\BuyAndSellProposal;
use App\BuyAndSellProposalItem;
use App\TargetRevenue;
use Khill\Lavacharts\Lavacharts;
use App\Group;

class User extends Authenticatable
{
   use SoftDeletes;
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'name', 'email', 'password', 'is_active'
   ];

   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
      'password', 'remember_token',
   ];

   public function customers()
   {
      return $this->hasMany(Customer::class);
   }

   public function target_revenue()
   {
      return $this->hasOne(TargetRevenue::class);
   }

   public function isActivate() {
		return (bool) $this->is_active;
	}

   public static function createUser($createUserRequest)
   {
      $user = new User();
      $user->name = $createUserRequest->get('name');
      $user->email = $createUserRequest->get('email');
      $user->password = bcrypt($createUserRequest->get('password'));
      $user->role = $createUserRequest->get('role');

      if($user->save()) {
         $alert = "success";
         $icon = "check";

         return redirect()->back()->with('message', 'User ' . $user->name . ' was successfully created')->with('alert', $alert)
         ->with('icon', $icon);
      } else {
         $alert = "danger";
         $icon = "times";

         return redirect()->back()->with('message', 'Adding user was unsuccessful')->with('alert', $alert)
         ->with('icon', $icon);
      }
   }

   public static function adminDashboard()
   {
      $ctr = 0;
      $indented_proposals = IndentedProposal::orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'indented_proposals');

      $ctr2 = 0;
      $buy_and_sell_proposals = BuyAndSellProposal::orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'buy_and_sell_proposals');

      $users = User::all();

      // create datatable
      $lava = new Lavacharts();

      $reasons = $lava->DataTable();
      $reasons->addStringColumn('Users')
      ->addNumberColumn('Percent');
      foreach($users as $user) {
         $reasons->addRow(array($user->name, $user->id));
      }

      $piechart = $lava->PieChart('USERS')
      ->setOptions(array(
         'datatable' => $reasons,
         'title' => 'Project Sales',
         'is3D' => true,
         'height' => 400,
         'width' => 400
      ));

      /*
      * TARGET SALES CHART
      */

      $targetRevenues = TargetRevenue::all();

      $target_chart = new Lavacharts();
      $data = $target_chart->DataTable();
      $data->addStringColumn('Groups')
      ->addNumberColumn('Current Sale');


      foreach($targetRevenues as $targetRevenue) {
         $data->addRow(array('Current Sale', $targetRevenue->current_sale));
      }

      $pie_chart = $target_chart->ColumnChart('TARGETSALE')
      ->setOptions(array(
         'datatable' => $data,
         'title' => 'Total Sales',
         'height' => 500,
         'width' => 700
      )
   );

   return view('auth.admin.dashboard', compact('target_chart', 'lava', 'indented_proposals', 'buy_and_sell_proposals', 'ctr', 'ctr2'));
}

public static function salesEngineerDashboard()
{
   $project_tally = 0;
   $aftermarket_tally = 0;

   $ctr = 0;
   $indented_proposals = IndentedProposal::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'indented_proposals');

   $ctr2 = 0;
   $buy_and_sell_proposals = BuyAndSellProposal::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(20, ['*'], 'buy_and_sell_proposals');
   // Project Chart
   $mostSoldProjects = DB::table('indented_proposals')
   ->select(
      'indented_proposal_item.*',
      DB::raw('count("wr_crm_indented_proposal_item.item_id") as "total_project_sold"'),
      DB::raw('wr_crm_indented_proposal_item.item_id as "project"'),
      'projects.*',
      DB::raw('wr_crm_projects.name as "project_name"'))
      ->leftJoin('indented_proposal_item', function($join) {
         $join->on('indented_proposal_item.indented_proposal_id', '=', 'indented_proposals.id');
      })
      ->leftJoin('projects', function($join) {
         $join->on('indented_proposal_item.item_id', '=', 'projects.id');
      })
      ->where('indented_proposals.collection_status', '=', 'COMPLETED')
      ->where('indented_proposal_item.type', '=', 'projects')
      ->where('indented_proposals.user_id', '=', Auth::user()->id)
      ->take(5)
      ->groupBy('project')
      ->orderBy('total_project_sold', 'DESC')
      ->get();

      foreach($mostSoldProjects as $mostSoldProject) {
         $project_tally += $mostSoldProject->total_project_sold;
      }

      $chartForMostSoldProjects = new Lavacharts();

      $most_sold_projects = $chartForMostSoldProjects->DataTable();
      $most_sold_projects->addStringColumn('Projects')
      ->addNumberColumn('Percent');
      foreach($mostSoldProjects as $mostSoldProject) {
         $most_sold_projects->addRow(array($mostSoldProject->project_name, $mostSoldProject->total_project_sold));
      }

      $pie_chart = $chartForMostSoldProjects->PieChart('MOSTSOLDPROJECTS')
      ->setOptions(array(
         'datatable' => $most_sold_projects,
         'title' => '[5] Most Sold Projects',
         'is3D' => true,
         'height' => 400,
         'width' => 500
      ));

      // Aftermarket Chart
      $mostSoldAfterMarkets = DB::table('indented_proposals')
      ->select(
         'indented_proposal_item.*',
         DB::raw('count("wr_crm_indented_proposal_item.item_id") as "total_aftermarkets_sold"'),
         DB::raw('wr_crm_indented_proposal_item.item_id as "aftermarket"'),
         'after_markets.*',
         DB::raw('wr_crm_after_markets.name as "aftermarket_name"'))
         ->leftJoin('indented_proposal_item', function($join) {
            $join->on('indented_proposal_item.indented_proposal_id', '=', 'indented_proposals.id');
         })
         ->leftJoin('after_markets', function($join) {
            $join->on('indented_proposal_item.item_id', '=', 'after_markets.id');
         })
         ->where('indented_proposals.collection_status', '=', 'COMPLETED')
         ->where('indented_proposals.user_id', '=', Auth::user()->id)
         ->where('indented_proposal_item.type', '=', 'after_markets')
         ->take(5)
         ->groupBy('aftermarket')
         ->orderBy('total_aftermarkets_sold', 'DESC')
         ->get();

         foreach($mostSoldAfterMarkets as $mostSoldAfterMarket) {
            $aftermarket_tally += $mostSoldAfterMarket->total_aftermarkets_sold;
         }

         $chartForMostSoldAftermarket = new Lavacharts();

         $most_sold_aftermarket = $chartForMostSoldAftermarket->DataTable();
         $most_sold_aftermarket->addStringColumn('Aftermarkets')
         ->addNumberColumn('Percent');
         foreach($mostSoldAfterMarkets as $mostSoldAfterMarket) {
            $most_sold_aftermarket->addRow(array($mostSoldAfterMarket->aftermarket_name, $mostSoldAfterMarket->total_aftermarkets_sold));
         }

         $pie_charts = $chartForMostSoldAftermarket->PieChart('MOSTSOLDAFTERMARKETS')
         ->setOptions(array(
            'datatable' => $most_sold_aftermarket,
            'title' => '[5] Most Sold Aftermarkets',
            'is3D' => true,
            'height' => 400,
            'width' => 500
         ));

         return view('auth.sales_engineer.dashboard', compact('chartForMostSoldProjects', 'chartForMostSoldAftermarket',
         'indented_proposals', 'buy_and_sell_proposals', 'ctr', 'ctr2', 'aftermarket_tally', 'project_tally'));
      }

      public static function adminUpdateProfile($updateUserProfile)
      {
         if($updateUserProfile->has('password')) {
            $user = User::find(Auth::user()->id);
            $user->name = ucwords($updateUserProfile->get('name'), ' ');
            $user->email = $updateUserProfile->get('email');
            $user->password = bcrypt($updateUserProfile->get('password'));

            if($user->save()) {
               return redirect()->back()->with('message', 'You have successfully update your information');
            }
         }

         $user = User::find(Auth::user()->id);
         $user->name = ucwords($updateUserProfile->get('name'), ' ');
         $user->email = $updateUserProfile->get('email');

         if($user->save()) {
            return redirect()->back()->with('message', 'You have successfully update your information');
         }
      }

      public static function seUpdateProfile($updateUserProfile)
      {
         if($updateUserProfile->has('password')) {
            $user = User::find(Auth::user()->id);
            $user->name = ucwords($updateUserProfile->get('name'), ' ');
            $user->email = $updateUserProfile->get('email');
            $user->password = bcrypt($updateUserProfile->get('password'));

            if($user->save()) {
               return redirect()->back()->with('message', 'You have successfully update your information');
            }
         }

         $user = User::find(Auth::user()->id);
         $user->name = ucwords($updateUserProfile->get('name'), ' ');
         $user->email = $updateUserProfile->get('email');

         if($user->save()) {
            return redirect()->back()->with('message', 'You have successfully update your information');
         }
      }

      public static function collectionUpdateProfile($updateUserProfile)
      {
         if($updateUserProfile->has('password')) {
            $user = User::find(Auth::user()->id);
            $user->name = ucwords($updateUserProfile->get('name'), ' ');
            $user->email = $updateUserProfile->get('email');
            $user->password = bcrypt($updateUserProfile->get('password'));

            if($user->save()) {
               return redirect()->back()->with('message', 'You have successfully update your information');
            }
         }

         $user = User::find(Auth::user()->id);
         $user->name = ucwords($updateUserProfile->get('name'), ' ');
         $user->email = $updateUserProfile->get('email');

         if($user->save()) {
            return redirect()->back()->with('message', 'You have successfully update your information');
         }
      }
   }
