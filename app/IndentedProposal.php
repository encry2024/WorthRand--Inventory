<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Input;
use Storage;
use File;
use Auth;
use App\TargetRevenue;

class IndentedProposal extends Model
{
    //
    protected $fillable = ['collection_status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function salesEngineerPostCreateIndentedProposal($request)
    {
        if(trim($request->get('array_id')) == "") {
            return redirect()->back()->with('message', 'You didn\'t select any item')
            ->with('alert', "search-error")->with('msg_icon', "glyphicon glyphicon-warning-sign");
        } else {
            $array_id = [];
            $item_ids = explode(',', $request->get('array_id'));

            $indented_proposal = new IndentedProposal();
            $indented_proposal->status = "DRAFT";
            $indented_proposal->user_id = Auth::user()->id;
            $indented_proposal->collection_status = 'ON-CREATE';

            if($indented_proposal->save()) {
                foreach($item_ids as $item_id) {
                    $explodedValue = explode('-', $item_id);
                    $id = $explodedValue[0];
                    $table = $explodedValue[1];

                    $indented_proposal_item = new IndentedProposalItem();
                    $indented_proposal_item->indented_proposal_id = $indented_proposal->id;
                    $indented_proposal_item->item_id = $id;
                    $indented_proposal_item->type = $table;
                    $indented_proposal_item->save();
                }
            }

            return redirect()->to('/sales_engineer/indented_proposal/'.$indented_proposal->id);
        }
    }

    public static function viewIndentedProposal($indentedProposal)
    {
        $ctr = 0;
        $customers = Customer::whereUserId(Auth::user()->id)->get();
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

        return view('proposal.sales_engineer.indented.create', compact('selectedItems', 'ctr', 'indentedProposal', 'customers'));
    }

    public static function saveIndentedProposal($createIndentedProposalRequest)
    {
        $indented_proposal = IndentedProposal::find($createIndentedProposalRequest->get('indent_proposal_id'));
        $indented_proposal->customer_id = $createIndentedProposalRequest->get('customer_id');
        $indented_proposal->branch_id = $createIndentedProposalRequest->get('branch_id');
        $indented_proposal->purchase_order = $createIndentedProposalRequest->get('rfq_number');
        $indented_proposal->ship_to = $createIndentedProposalRequest->get('ship_to');
        $indented_proposal->ship_to_address = $createIndentedProposalRequest->get('ship_to_address');
        $indented_proposal->status = "SENT";
        $indented_proposal->collection_status = "PENDING";

        if($indented_proposal->save()) {
            foreach($createIndentedProposalRequest->all() as $key => $value) {
                if(strpos($key, 'quantity') !== FALSE)  {
                    foreach($value as $indented_proposal_item_id => $quantity_value) {
                        $indented_proposal_item = IndentedProposalItem::find($indented_proposal_item_id);
                        $indented_proposal_item->quantity = $quantity_value;
                        $indented_proposal_item->save();
                    }
                }

                if(strpos($key, 'price') !== FALSE) {
                    foreach($value as $indented_proposal_item_id => $quantity_value) {
                        $indented_proposal_item = IndentedProposalItem::find($indented_proposal_item_id);
                        $indented_proposal_item->price = $quantity_value;
                        $indented_proposal_item->save();
                    }
                }

                if(strpos($key, 'delivery') !== FALSE) {
                    foreach($value as $indented_proposal_item_id => $quantity_value) {
                        $indented_proposal_item = IndentedProposalItem::find($indented_proposal_item_id);
                        $indented_proposal_item->delivery = $quantity_value * 7;
                        $indented_proposal_item->notify_me_after = ($quantity_value - 2) * 7;
                        $indented_proposal_item->save();
                    }
                }
            }

            $indented_proposal_items = IndentedProposalItem::whereIndentedProposalId($indented_proposal->id)->get();

            foreach($indented_proposal_items as $indentedProposalItem) {
                $indentedProposalItem->status = "PROCESSING";
                $indentedProposalItem->save();

                if($indentedProposalItem->save()) {
                    if($indentedProposalItem->type == "projects") {
                        $project_pricing_history = new ProjectPricingHistory();
                        $project_pricing_history->project_id = $indentedProposalItem->item_id;
                        $project_pricing_history->price = $indentedProposalItem->price;
                        $project_pricing_history->pricing_date = date('Y');
                        $project_pricing_history->terms = $indented_proposal->terms_of_payment_1;
                        $project_pricing_history->delivery = "TEST DELIVERY";
                        $project_pricing_history->fpd_reference = "TEST_FPD_REFERENCE";
                        $project_pricing_history->wpc_reference = "TEST_WPC_REFERENCE";
                        $project_pricing_history->po_number = $indented_proposal->purchase_order;

                        if($project_pricing_history->save()) {
                            $project = Project::find($project_pricing_history->project_id);
                            $project->price = $project_pricing_history->price;
                            $project->save();
                        }
                    } else if($indentedProposalItem->type == "after_markets") {
                        $after_marketpricing_history = new AfterMarketPricingHistory();
                        $after_marketpricing_history->after_market_id = $indentedProposalItem->item_id;
                        $after_marketpricing_history->price = $indentedProposalItem->price;
                        $after_marketpricing_history->pricing_date = date('Y');
                        $after_marketpricing_history->terms = $indented_proposal->terms_of_payment_1;
                        $after_marketpricing_history->delivery = "TEST DELIVERY";
                        $after_marketpricing_history->fpd_reference = "TEST_FPD_REFERENCE";
                        $after_marketpricing_history->wpc_reference = "TEST_WPC_REFERENCE";
                        $after_marketpricing_history->po_number = $indented_proposal->purchase_order;

                        if($after_marketpricing_history->save()) {
                            $aftermarket = AfterMarket::find($after_marketpricing_history->after_market_id);
                            $aftermarket->price = $after_marketpricing_history->price;
                            $aftermarket->save();
                        }
                    }
                }
            }


            return redirect()->to('/sales_engineer/search')->with('message', 'Indented Proposal [ Purchase Order Number: #'.$indented_proposal->purchase_order.' ] was successfully sent.')
                ->with('alert', "alert-success");
        }
    }

    public static function showSentIndentedProposal($indented_proposal)
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
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();

        return view('proposal.sales_engineer.indented.sent', compact('indented_proposal', 'selectedItems', 'ctr'));
    }

    public static function showCreateIndentedProposal($indented_proposal)
    {
       // if($indented_proposal->status == "SENT") {
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
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();

        return view('proposal.sales_engineer.indented.create', compact('indented_proposal', 'selectedItems', 'ctr'));
    }

    public static function showPendingIndentedProposal($indented_proposal)
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
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();

        return view('proposal.admin.indented_proposal.pending', compact('indented_proposal', 'selectedItems', 'ctr'));
    }

    public static function collectIndentedProposal($request, $indentedProposal)
    {
        $total_collected = "";
        if($indentedProposal->collection_status == "FOR-COLLECTION") {
            $indented_proposal_items = IndentedProposalItem::where('indented_proposal_id', $request->get('indent_proposal_id'))->get();
            $user = User::find($indentedProposal->user_id);
            $getTargetRevenueId = TargetRevenue::whereUserId($indentedProposal->user_id)->first();

            if(count($getTargetRevenueId) != 0) {
                foreach($indented_proposal_items as $indented_proposal_item) {
                    $total_collected += $indented_proposal_item->price * $indented_proposal_item->quantity;
                    $total_price = $indented_proposal_item->price * $indented_proposal_item->quantity;

                    $target_revenue_history = new TargetRevenueHistory();
                    $target_revenue_history->target_revenue_id = $getTargetRevenueId->id;
                    $target_revenue_history->collected = $total_price;
                    $target_revenue_history->date = date('Y-m-d');
                    $target_revenue_history->proposal_type = 'indented_proposal';
                    $target_revenue_history->proposal_id = $indentedProposal->id;
                    $target_revenue_history->save();
                }

                $target_revenue = TargetRevenue::whereUserId($indentedProposal->user_id)->first();
                $target_revenue->current_sale = $total_collected;
                $target_revenue->save();

                $indentedProposal->status = "COMPLETED";
                $indentedProposal->collection_status = "COMPLETED";
                $indentedProposal->save();

                return redirect()->back()
                    ->with('message', 'Collected amount was added to [ ' . ucwords($user->name, " ") . ' ] \'s Target Revenue .')
                    ->with('alert', "alert-success")
                    ->with('bg-success', '#5cb85c')
                    ->with('alert-icon', 'fa fa-check');
            } else {
                return redirect()->back()
                    ->with('message', ucwords($user->name, " ") . '\'s Target Revenue has not been set. Please inform the Administration.')
                    ->with('alert', "alert-danger")
                    ->with('bg-error', '#d9534f')
                    ->with('alert-icon', 'fa fa-bolt');
            }
        }
    }

    public static function showAcceptedIndentedProposal($indentedProposal)
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

        return view('proposal.assistant.indented_proposal.accepted', compact('ctr', 'selectedItems', 'indentedProposal'));
    }

    public static function viewSentIndentedProposal($indented_proposal)
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
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();

        return view('proposal.sales_engineer.indented.sent', compact('ctr', 'selectedItems', 'indented_proposal'));
    }

    public static function showDraftIndentedProposal($indentedProposal)
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

        return view('proposal.sales_engineer.indented.draft', compact('indentedProposal', 'selectedItems', 'ctr'));
    }
}
