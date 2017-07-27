<?php

namespace App\Http\Controllers\SalesEngineer;

use App\AfterMarket;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Seal;
use DB;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
   /**
   * ItemController constructor.
   */
   public function __construct()
   {
      $this->middleware('verify_if_user_is_sales_engineer');
   }

   public function salesEngineerProjectIndex()
   {
      $projects = Project::paginate(30);
      $projects->setPath('/projects');

      return view('item.project.sales_engineer.index', compact('projects'));
   }

   public function salesEngineerProjectShow(Project $project)
   {
      return view('item.project.sales_engineer.show', compact('project'));
   }

   public function salesEngineerProjectPricingHistoryIndex(Project $project)
   {
      return view('item.project.sales_engineer.pricing_history.index', compact('project'));
   }

   public function indexAftermarket()
   {
      $aftermarkets = AfterMarket::paginate(30);
      $aftermarkets->setPath('/aftermarkets');

      return view('item.after_market.sales_engineer.index', compact('aftermarkets'));
   }

   public function showAftermarket(AfterMarket $afterMarket)
   {
      return view('item.after_market.sales_engineer.show', compact('afterMarket'));
   }

   public function afterMarketPricingHistoryIndex(AfterMarket $afterMarket)
   {
      return view('item.after_market.sales_engineer.pricing_history.index', compact('afterMarket'));
   }

   public function salesEngineerSealIndex()
   {
      $ctr = 0;
      $seals = Seal::paginate(30);
      $seals->setPath('/seals');

      return view('item.seal.sales_engineer.index', compact('seals', 'ctr'));
   }

   public function salesEngineerShowSeal(Seal $seal)
   {
      return view('item.seal.sales_engineer.show', compact('seal'));
   }

   public function getItemBasedOnCategory($category)
   {
      $itemArray = array();


      if($category == 'projects') {
         $items = DB::table('projects')->get();

         foreach($items as $item) {
            $pricing_history = DB::table('project_pricing_histories')
            ->where('project_pricing_histories.project_id', '=', $item->id)
            ->latest()->get();

            $itemArray['suggestions'][] = [
               'data' => $item->id,
               'item_id' => $item->id,
               'value' => $item->material_number,
               'dataCollection1' => $item->name,
               'dataCollection2' => $item->status,
               'dataCollection3' => $item->epc,
               'dataCollection4' => $item->final_result,
               'dataCollection5' => $item->reference_number,
               'dataCollection6' => $item->serial_number,
               'dataCollection7' => $item->drawing_number,
               'dataCollection8' => $item->tag_number,
               'table_name' => $category,
               'pricinHistoryArray' => $pricing_history,

            ];
         }
      } else if($category == 'after_markets') {
         $items = DB::table('after_markets')->get();

         foreach($items as $item) {
            $pricing_history = DB::table('after_market_pricing_histories')
            ->where('after_market_pricing_histories.after_market_id', '=', $item->id)
            ->latest()->get();

            $itemArray['suggestions'][] = [
               'data' => $item->id,
               'item_id' => $item->id,
               'value' => $item->material_number,
               'dataCollection1' => $item->name,
               'dataCollection2' => $item->ccn_number,
               'dataCollection3' => $item->part_number,
               'dataCollection4' => $item->model,
               'dataCollection5' => $item->reference_number,
               'dataCollection6' => $item->drawing_number,
               'dataCollection7' => $item->serial_number,
               'dataCollection8' => $item->tag_number,
               'table_name' => $category,
               'pricinHistoryArray' => $pricing_history,

            ];
         }
      } else {
         foreach($items as $item) {
            $pricing_history = DB::table('seal_pricing_histories')
            ->where('seal_pricing_histories.seal_id', '=', $item->id)
            ->latest()->get();

            $itemArray['suggestions'][] = [
               'data' => $item->id,
               'item_id' => $item->id,
               'value' => $item->name,
               'dataCollection1' => $item->material_number,
               'dataCollection2' => $item->drawing_number,
               'dataCollection3' => $item->bom_number,
               'dataCollection4' => $item->end_user,
               'dataCollection5' => $item->seal_type,
               'dataCollection6' => $item->size,
               'dataCollection7' => $item->code,
               'dataCollection8' => $item->model,
               'table_name' => $category,
               'pricinHistoryArray' => $pricing_history,
            ];
         }
      }

      return json_encode($itemArray);
   }
}
