<?php

namespace App\Http\Controllers\Collection;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndentedProposal;
use DB;

class ProposalController extends Controller
{
    //

    public function indexIndentedProposal()
    {
        $ctr = 0;
        $indented_proposals = IndentedProposal::where('collection_status', 'DELAYED')->orWhere('collection_status', 'COMPLETED')
            ->orWhere('collection_status', 'PROCESSING')->orWhere('collection_status', 'ACCEPTED')->orWhere('collection_status', 'DECLINED')
            ->orWhere('collection_status', 'FOR-COLLECTION')->paginate(30);

        return view('proposal.collection.indented_proposal.index', compact('indented_proposals', 'ctr'));
    }

    public function forCollection(IndentedProposal $indentedProposal)
    {
        $ctr = 0;
        $selectedItems = DB::table('indented_proposal_item')
            ->select('projects.*',
                DB::raw('wr_crm_projects.name as "project_name"'),
                DB::raw('wr_crm_projects.model as "project_md"'),
                DB::raw('wr_crm_projects.serial_number as "project_sn"'),
                DB::raw('wr_crm_projects.part_number as "project_pn"'),
                DB::raw('wr_crm_projects.drawing_number as "project_dn"'),
                DB::raw('wr_crm_projects.tag_number as "project_tn"'),
                DB::raw('wr_crm_projects.material_number as "project_mn"'),
                DB::raw('wr_crm_projects.price as "project_price"'),
                'after_markets.*',
                DB::raw('wr_crm_after_markets.name as "after_market_name"'),
                DB::raw('wr_crm_after_markets.model as "after_market_md"'),
                DB::raw('wr_crm_after_markets.part_number as "after_market_pn"'),
                DB::raw('wr_crm_after_markets.drawing_number as "after_market_dn"'),
                DB::raw('wr_crm_after_markets.material_number as "after_market_mn"'),
                DB::raw('wr_crm_after_markets.material_number as "after_market_sn"'),
                DB::raw('wr_crm_after_markets.tag_number as "after_market_tn"'),
                DB::raw('wr_crm_after_markets.price as "after_market_price"'),
                'indented_proposal_item.*',
                DB::raw('wr_crm_indented_proposal_item.id as "indented_proposal_item_id"'),
                DB::raw('wr_crm_indented_proposal_item.quantity as "indented_proposal_item_quantity"'),
                DB::raw('wr_crm_indented_proposal_item.delivery as "indented_proposal_item_delivery"'),
                DB::raw('wr_crm_indented_proposal_item.price as "indented_proposal_item_price"'),
                DB::raw('wr_crm_indented_proposal_item.notify_me_after as "indented_proposal_item_notify_me_after"'))
            ->leftJoin('projects', function($join) {
                $join->on('indented_proposal_item.item_id', '=', 'projects.id')
                    ->where('indented_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
                $join->on('indented_proposal_item.item_id', '=', 'after_markets.id')
                    ->where('indented_proposal_item.type', '=', 'after_markets');
            })
            ->where('indented_proposal_item.indented_proposal_id', '=', $indentedProposal->id)->get();

        return view('proposal.collection.indented_proposal.collect', compact('indentedProposal', 'selectedItems', 'ctr'));
    }

    public function collectIndentedProposal(Request $request, IndentedProposal $indentedProposal)
    {
        $collect_proposal = IndentedProposal::collectIndentedProposal($request, $indentedProposal);

        return $collect_proposal;
    }
}
