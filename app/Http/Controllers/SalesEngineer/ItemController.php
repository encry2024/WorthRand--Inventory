<?php

namespace App\Http\Controllers\SalesEngineer;

use App\AfterMarket;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
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
        $projects = Project::all();

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
        $aftermarkets = AfterMarket::all();

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

    public function getItemBasedOnCategory($category)
    {
        $itemArray = array();
        $items = DB::table($category)->get();

        foreach($items as $item) {
            $pricing_history = DB::table(str_singular($category).'_pricing_histories')
            ->where(str_singular($category).'_pricing_histories.' . str_singular($category) . '_id', '=', $item->id)
            ->latest()->get();

            $itemArray['suggestions'][] = [
                'data' => $item->id,
                'item_id' => $item->id,
                'value' => $item->name,
                'material_number' => $item->material_number,
                'ccn_number' => $item->ccn_number,
                'part_number' => $item->part_number,
                'model' => $item->model,
                'reference_number' => $item->reference_number,
                'serial_number' => $item->serial_number,
                'drawing_number' => $item->drawing_number,
                'tag_number' => $item->tag_number,
                'table_name' => $category,
                'pricinHistoryArray' => $pricing_history
            ];
        }

        return json_encode($itemArray);
    }
}
