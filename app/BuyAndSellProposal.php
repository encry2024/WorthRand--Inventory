<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyAndSellProposal extends Model
{
    public static function adminPostCreateBuyAndSellProposal($request)
    {
        $array_id = [];
        $item_ids = explode(',', $request->get('array_id'));

        $buy_and_sell_proposal = new BuyAndSellProposal();
        $buy_and_sell_proposal->status = "DRAFT";

        if($buy_and_sell_proposal->save()) {
            foreach($item_ids as $item_id) {
                $explodedValue = explode('-', $item_id);
                $id = $explodedValue[0];
                $table = $explodedValue[1];

                $buy_and_sell_proposal_item = new BuyAndSellProposalitem();
                $buy_and_sell_proposal_item->$buy_and_sell_proposal = $buy_and_sell_proposal->id;
                $buy_and_sell_proposal_item->item_id = $id;
                $buy_and_sell_proposal_item->type = $table;
                $buy_and_sell_proposal_item->save();
            }
        }

        return redirect()->to('/admin/buy_and_sell_proposal/'.$buy_and_sell_proposal->id);
    }

    public static function viewBuyAndSellProposal($buyAndSellProposal)
    {
        $selectedItems = DB::table('buy_and_sell_proposal_item')
            ->select('projects.*',
                DB::raw('wr_crm_projects.name as "project_name"'),
                DB::raw('wr_crm_projects.model as "project_md"'),
                DB::raw('wr_crm_projects.serial_number as "project_sn"'),
                DB::raw('wr_crm_projects.part_number as "project_pn"'),
                DB::raw('wr_crm_projects.drawing_number as "project_dn"'),
                DB::raw('wr_crm_projects.tag_number as "project_tn"'),
                DB::raw('wr_crm_projects.material_number as "project_mn"'),
                'after_markets.*',
                DB::raw('wr_crm_after_markets.name as "after_market_name"'),
                DB::raw('wr_crm_after_markets.model as "after_market_md"'),
                DB::raw('wr_crm_after_markets.part_number as "after_market_pn"'),
                DB::raw('wr_crm_after_markets.drawing_number as "after_market_dn"'),
                DB::raw('wr_crm_after_markets.material_number as "after_market_mn"'),
                DB::raw('wr_crm_after_markets.material_number as "after_market_sn"'),
                DB::raw('wr_crm_after_markets.tag_number as "after_market_tn"'))
            ->leftJoin('projects', function($join) {
                $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
                    ->where('buy_and_sell_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
                $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
                    ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
            })
            ->where('buy_and_sell_proposal_item.indented_proposal_id', '=', $buyAndSellProposal->id)->get();

        return view('proposal.admin.buy_and_sell.create', compact('selectedItems'));
    }
}