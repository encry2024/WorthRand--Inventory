<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\BuyAndSellProposalItem;
use App\ProjectPricingHistory;
use App\AfterMarketPricingHistory;
use App\Project;
use App\AfterMarket;

class BuyAndSellProposal extends Model
{
   protected $fillable = ['collection_status', 'qrc_ref', 'validity', 'payment_terms', 'purchase_order'];

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

   public function buy_and_sell_proposal_items()
   {
      return $this->hasMany(BuyAndSellProposalItem::class);
   }

   public static function salesEngineerPostCreateBuyAndSellProposal($request)
   {
      if(trim($request->get('array_id')) == "") {
         return redirect()->back()->with('message', 'You didn\'t select any item')->with('alert', "search-error")->with('msg_icon', 'fa fa-exclamation-circle');
      } else {
         $array_id = [];
         $item_ids = explode(',', $request->get('array_id'));

         $buy_and_sell_proposal = new BuyAndSellProposal();
         $buy_and_sell_proposal->user_id = Auth::user()->id;
         $buy_and_sell_proposal->status = "DRAFT";
         $buy_and_sell_proposal->collection_status = 'ON-CREATE';

         if($buy_and_sell_proposal->save()) {
            foreach($item_ids as $item_id) {
               $explodedValue = explode('-', $item_id);
               $id = $explodedValue[0];
               $table = $explodedValue[1];

               $buy_and_sell_proposal_item = new BuyAndSellProposalItem();
               $buy_and_sell_proposal_item->buy_and_sell_proposal_id = $buy_and_sell_proposal->id;
               $buy_and_sell_proposal_item->item_id = $id;
               $buy_and_sell_proposal_item->type = $table;
               $buy_and_sell_proposal_item->save();
            }
         }

         return redirect()->to('/sales_engineer/buy_and_resale_proposal/'.$buy_and_sell_proposal->id);
      }
   }

   public static function viewBuyAndSellProposal($buyAndSellProposal)
   {
      $ctr = 0;
      $selectedItems = DB::table('buy_and_sell_proposal_item')
      ->select('projects.*',
      DB::raw('wr_crm_projects.name as "project_name"'),
      DB::raw('wr_crm_projects.status as "project_md"'),
      DB::raw('wr_crm_projects.serial_number as "project_sn"'),
      DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
      'seals.*',
      DB::raw('wr_crm_seals.name as "seal_name"'),
      DB::raw('wr_crm_seals.model as "seal_model"'),
      DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
      DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
      DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
      DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
      DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
      DB::raw('wr_crm_seals.price as "seal_price"'),
      'buy_and_sell_proposal_item.*',
      DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'))
      ->leftJoin('projects', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'projects');
      })
      ->leftJoin('after_markets', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
      })
      ->leftJoin('seals', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'seals');
      })
      ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

      return view('proposal.sales_engineer.buy_and_sell.create', compact('selectedItems', 'ctr','buyAndSellProposal'));
   }

   public static function draftBuyAndResaleProposal($buyAndSellProposal)
   {
      $ctr = 0;
      $selectedItems = DB::table('buy_and_sell_proposal_item')
      ->select('projects.*',
      DB::raw('wr_crm_projects.name as "project_name"'),
      DB::raw('wr_crm_projects.status as "project_md"'),
      DB::raw('wr_crm_projects.serial_number as "project_sn"'),
      DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
      'seals.*',
      DB::raw('wr_crm_seals.name as "seal_name"'),
      DB::raw('wr_crm_seals.model as "seal_model"'),
      DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
      DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
      DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
      DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
      DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
      DB::raw('wr_crm_seals.price as "seal_price"'),
      'buy_and_sell_proposal_item.*',
      DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'))
      ->leftJoin('projects', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'projects');
      })
      ->leftJoin('after_markets', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
      })
      ->leftJoin('seals', function($join) {
         $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
         ->where('buy_and_sell_proposal_item.type', '=', 'seals');
      })
      ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

      return view('proposal.sales_engineer.buy_and_sell.draft', compact('selectedItems', 'ctr','buyAndSellProposal'));
   }

   public static function saveBuyAndSellProposal($createBuyAndSellProposalRequest)
   {
      $buy_and_sell_proposal = BuyAndSellProposal::find($createBuyAndSellProposalRequest->get('buy_and_sell_proposal_id'));
      $buy_and_sell_proposal->wpc_reference = strtoupper($createBuyAndSellProposalRequest->get('wpc_reference'));
      $buy_and_sell_proposal->date = date('Y');
      $buy_and_sell_proposal->invoice_to = strtoupper($createBuyAndSellProposalRequest->get('invoice_to'));
      $buy_and_sell_proposal->invoice_address = strtoupper($createBuyAndSellProposalRequest->get('invoice_address'));
      $buy_and_sell_proposal->qrc_ref = strtoupper($createBuyAndSellProposalRequest->get('qrc_reference'));
      $buy_and_sell_proposal->validity = strtoupper($createBuyAndSellProposalRequest->get('validity'));
      $buy_and_sell_proposal->payment_terms = strtoupper($createBuyAndSellProposalRequest->get('terms'));
      $buy_and_sell_proposal->status = "SENT";
      $buy_and_sell_proposal->collection_status = "PENDING";
      $buy_and_sell_proposal->user_id = Auth::user()->id;
      $buy_and_sell_proposal->customer_id = $createBuyAndSellProposalRequest->get('customer_id');

      if($buy_and_sell_proposal->save()) {
         foreach($createBuyAndSellProposalRequest->all() as $key => $value) {
            if(strpos($key, 'quantity') !== FALSE)  {
               foreach($value as $buy_and_sell_proposal_id => $quantity_value) {
                  $buy_and_sell_proposal_item = BuyAndSellProposalItem::find($buy_and_sell_proposal_id);
                  $buy_and_sell_proposal_item->quantity = $quantity_value;
                  $buy_and_sell_proposal_item->save();
               }
            }

            if(strpos($key, 'price') !== FALSE) {
               foreach($value as $buy_and_sell_proposal_id => $price) {
                  $buy_and_sell_proposal_item = BuyAndSellProposalItem::find($buy_and_sell_proposal_id);
                  $buy_and_sell_proposal_item->price = str_replace(',', '', $price);
                  $buy_and_sell_proposal_item->save();
               }
            }

            if(strpos($key, 'delivery') !== FALSE) {
               foreach($value as $buy_and_sell_proposal_id => $delivery) {
                  $buy_and_sell_proposal_item = BuyAndSellProposalItem::find($buy_and_sell_proposal_id);
                  $buy_and_sell_proposal_item->delivery = $delivery * 7;
                  $buy_and_sell_proposal_item->save();
               }
            }
         }

         $buy_and_sell_proposal_items = BuyAndSellProposalItem::where('buy_and_sell_proposal_id', $buy_and_sell_proposal->id)->get();

         foreach($buy_and_sell_proposal_items as $buyAndSellProposalItem) {
            $buyAndSellProposalItem->status = "PROCESSING";

            if($buyAndSellProposalItem->save()) {
               if($buyAndSellProposalItem->type == "projects") {
                  $project_pricing_history = new ProjectPricingHistory();
                  $project_pricing_history->project_id = $buyAndSellProposalItem->item_id;
                  $project_pricing_history->price = str_replace(',', '', $buyAndSellProposalItem->price);
                  $project_pricing_history->pricing_date = date('Y');
                  $project_pricing_history->delivery = $buyAndSellProposalItem->delivery;
                  $project_pricing_history->wpc_reference = strtoupper($buy_and_sell_proposal->wpc_reference);
                  //$project_pricing_history->po_number = $buy_and_sell_proposal->purchase_order;

                  if($project_pricing_history->save()) {
                     $project = Project::find($project_pricing_history->project_id);
                     $project->price = str_replace(',', '', $project_pricing_history->price);
                     $project->save();
                  }
               } else if($buyAndSellProposalItem->type == "after_markets") {
                  $after_marketpricing_history = new AfterMarketPricingHistory();
                  $after_marketpricing_history->after_market_id = $buyAndSellProposalItem->item_id;
                  $after_marketpricing_history->price = str_replace(',', '', $buyAndSellProposalItem->price);
                  $after_marketpricing_history->pricing_date = date('Y');
                  $after_marketpricing_history->delivery = $buyAndSellProposalItem->delivery;
                  $after_marketpricing_history->wpc_reference = strtoupper($buy_and_sell_proposal->wpc_reference);
                  //$after_marketpricing_history->po_number = $buy_and_sell_proposal->purchase_order;

                  if($after_marketpricing_history->save()) {
                     $aftermarket = AfterMarket::find($after_marketpricing_history->after_market_id);
                     $aftermarket->price = str_replace(',', '', $after_marketpricing_history->price);
                     $aftermarket->save();
                  }
               } else if($buyAndSellProposalItem->type == "seals") {
                  $seal_pricing_history = new SealPricingHistory();
                  $seal_pricing_history->seal_id = $buyAndSellProposalItem->item_id;
                  $seal_pricing_history->price = str_replace(',', '', $buyAndSellProposalItem->price);
                  $seal_pricing_history->pricing_date = date('Y');
                  $seal_pricing_history->delivery = $buyAndSellProposalItem->delivery;
                  $seal_pricing_history->wpc_reference = strtoupper($buy_and_sell_proposal->wpc_reference);
                  //$seal_pricing_history->po_number = $buy_and_sell_proposal->purchase_order;

                  if($seal_pricing_history->save()) {
                     $seal = Seal::find($seal_pricing_history->seal_id);
                     $seal->price = str_replace(',', '', $seal_pricing_history->price);
                     $seal->save();
                  }
               }
            }
         }

         return redirect()->to('/sales_engineer/search')->with('message', 'Buy And Sell Proposal [ WPC Number/Reference: #'.$buy_and_sell_proposal->wpc_reference.' ] was successfully sent.')
         ->with('alert', "alert-success")->with('alert-icon', 'glyphicon glyphicon-ok');
      }
   }

   public static function showPendingBuyAndSellProposal($buyAndSellProposal)
   {
      $ctr = 0;
      $selectedItems = DB::table('buy_and_sell_proposal_item')
      ->select(
         'projects.*',
         DB::raw('wr_crm_projects.name as "project_name"'),
         DB::raw('wr_crm_projects.status as "project_md"'),
         DB::raw('wr_crm_projects.serial_number as "project_sn"'),
         DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
         'seals.*',
         DB::raw('wr_crm_seals.name as "seal_name"'),
         DB::raw('wr_crm_seals.model as "seal_model"'),
         DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
         DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
         DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
         DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
         DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
         DB::raw('wr_crm_seals.price as "seal_price"'),
         'buy_and_sell_proposal_item.*',
         DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
         DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
         DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
         DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
         DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
         ->leftJoin('projects', function($join) {
            $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
            ->where('buy_and_sell_proposal_item.type', '=', 'projects');
         })
         ->leftJoin('after_markets', function($join) {
            $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
            ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
         })
         ->leftJoin('seals', function($join) {
            $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
            ->where('buy_and_sell_proposal_item.type', '=', 'seals');
         })
         ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

         return view('proposal.admin.buy_and_sell_proposal.pending', compact('buyAndSellProposal', 'selectedItems', 'ctr'));
      }

      public static function showAssistantPendingBuyAndSellProposal($buyAndSellProposal)
      {
         $ctr = 0;
         $selectedItems = DB::table('buy_and_sell_proposal_item')
         ->select(
            'projects.*',
            DB::raw('wr_crm_projects.name as "project_name"'),
            DB::raw('wr_crm_projects.status as "project_md"'),
            DB::raw('wr_crm_projects.serial_number as "project_sn"'),
            DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
            'seals.*',
            DB::raw('wr_crm_seals.name as "seal_name"'),
            DB::raw('wr_crm_seals.model as "seal_model"'),
            DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
            DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
            DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
            DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
            DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
            DB::raw('wr_crm_seals.price as "seal_price"'),
            'buy_and_sell_proposal_item.*',
            DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
            ->leftJoin('projects', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
            })
            ->leftJoin('seals', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'seals');
            })
            ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

            return view('proposal.assistant.buy_and_sell_proposal.pending', compact('buyAndSellProposal', 'selectedItems', 'ctr'));
         }

         public static function viewAcceptedBuyAndSellProposal($buyAndSellProposal)
         {
            $ctr = 0;
            $selectedItems = DB::table('buy_and_sell_proposal_item')
            ->select(
               'projects.*',
               DB::raw('wr_crm_projects.name as "project_name"'),
               DB::raw('wr_crm_projects.status as "project_md"'),
               DB::raw('wr_crm_projects.serial_number as "project_sn"'),
               DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
               'seals.*',
               DB::raw('wr_crm_seals.name as "seal_name"'),
               DB::raw('wr_crm_seals.model as "seal_model"'),
               DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
               DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
               DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
               DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
               DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
               DB::raw('wr_crm_seals.price as "seal_price"'),
               'buy_and_sell_proposal_item.*',
               DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
               ->leftJoin('projects', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'projects');
               })
               ->leftJoin('after_markets', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
               })
               ->leftJoin('seals', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'seals');
               })
               ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

               return view('proposal.secretary.buy_and_sell.pending', compact('buyAndSellProposal', 'selectedItems', 'ctr'));
            }

            public static function viewSentBuyAndSellProposal($buyAndSellProposal)
            {
               $ctr = 0;
               $selectedItems = DB::table('buy_and_sell_proposal_item')
               ->select('projects.*',
               DB::raw('wr_crm_projects.name as "project_name"'),
               DB::raw('wr_crm_projects.status as "project_md"'),
               DB::raw('wr_crm_projects.serial_number as "project_sn"'),
               DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
               'seals.*',
               DB::raw('wr_crm_seals.name as "seal_name"'),
               DB::raw('wr_crm_seals.model as "seal_model"'),
               DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
               DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
               DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
               DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
               DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
               DB::raw('wr_crm_seals.price as "seal_price"'),
               'buy_and_sell_proposal_item.*',
               DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
               ->leftJoin('projects', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'projects');
               })
               ->leftJoin('after_markets', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
               })
               ->leftJoin('seals', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'seals');
               })
               ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

               return view('proposal.sales_engineer.buy_and_sell.sent', compact('ctr', 'selectedItems', 'buyAndSellProposal'));
            }

            public static function collectionViewPendingBuyAndSellProposal($buyAndSellProposal)
            {
               $ctr = 0;
               $selectedItems = DB::table('buy_and_sell_proposal_item')
               ->select('projects.*',
               DB::raw('wr_crm_projects.name as "project_name"'),
               DB::raw('wr_crm_projects.status as "project_md"'),
               DB::raw('wr_crm_projects.serial_number as "project_sn"'),
               DB::raw('wr_crm_projects.final_result as "project_pn"'),
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
               'seals.*',
               DB::raw('wr_crm_seals.name as "seal_name"'),
               DB::raw('wr_crm_seals.model as "seal_model"'),
               DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
               DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
               DB::raw('wr_crm_seals.serial_number as "seal_serial_number"'),
               DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
               DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
               DB::raw('wr_crm_seals.price as "seal_price"'),
               'buy_and_sell_proposal_item.*',
               DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
               DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
               ->leftJoin('projects', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'projects');
               })
               ->leftJoin('after_markets', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
               })
               ->leftJoin('seals', function($join) {
                  $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
                  ->where('buy_and_sell_proposal_item.type', '=', 'seals');
               })
               ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();

               $cheque = Cheque::whereProposalId($buyAndSellProposal->id)->whereProposalType("buy_and_sell_proposal")->first();

               return view('proposal.collection.buy_and_sell_proposal.collection', compact('ctr', 'selectedItems', 'buyAndSellProposal', 'cheque'));
            }

            public static function collectBuyAndSellProposal($request, $buyAndSellProposal)
            {
               $total_collected = "";
               if($buyAndSellProposal->collection_status == "FOR-COLLECTION") {
                  $buy_and_sell_proposal_items = BuyAndSellProposalItem::where('buy_and_sell_proposal_id', $request->get('buy_and_sell_proposal_id'))->get();
                  $user = User::find($buyAndSellProposal->user_id);
                  $getTargetRevenueId = TargetRevenue::whereUserId($buyAndSellProposal->user_id)->first();

                  if(count($getTargetRevenueId) != 0) {
                     $cheque = new Cheque();
                     $cheque->company_name = $request->get('company_name');
                     $cheque->amount = $request->get('amount');
                     $cheque->proposal_type = 'buy_and_sell_proposal';
                     $cheque->proposal_id = $buyAndSellProposal->id;
                     $cheque->save();

                     foreach($buy_and_sell_proposal_items as $buy_and_sell_proposal_item) {
                        $total_collected += str_replace(',', '', $buy_and_sell_proposal_item->price) * $buy_and_sell_proposal_item->quantity;
                        $total_price = str_replace(',', '', $buy_and_sell_proposal_item->price) * $buy_and_sell_proposal_item->quantity;

                        $target_revenue_history = new TargetRevenueHistory();
                        $target_revenue_history->target_revenue_id = $getTargetRevenueId->id;
                        $target_revenue_history->collected = $total_price;
                        $target_revenue_history->date = date('Y-m-d');
                        $target_revenue_history->proposal_type = 'buy_and_sell_proposal';
                        $target_revenue_history->proposal_id = $buyAndSellProposal->id;
                        $target_revenue_history->save();
                     }

                     $target_revenue = TargetRevenue::whereUserId($buyAndSellProposal->user_id)->first();
                     $target_revenue->save();

                     $buyAndSellProposal->status = "COMPLETED";
                     $buyAndSellProposal->collection_status = "COMPLETED";
                     $buyAndSellProposal->save();

                     return redirect()->back()
                     ->with('message', 'Collected amount was added to [ ' . ucwords($user->name, " ") . ' ] \'s Target Revenue .')
                     ->with('alert', "alert-success")
                     ->with('bg-alert', '#5cb85c')
                     ->with('alert-icon', 'fa fa-check');
                  } else {
                     return redirect()->back()
                     ->with('message', ucwords($user->name, " ") . '\'s Target Revenue has not been set. Please inform the Administration.')
                     ->with('alert', "alert-danger")
                     ->with('bg-alert', '#d9534f')
                     ->with('alert-icon', 'fa fa-bolt');
                  }
               }
            }
         }
