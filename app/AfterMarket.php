<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfterMarket extends Model
{
   use SoftDeletes;
   //
   protected $fillable = [
      'name', 'model', 'ccn_number', 'part_number', 'reference_number', 'drawing_number',
      'material_number', 'serial_number', 'tag_number', 'project_id', 'company_name', 'scanned_file'
   ];

   protected $dates = ['deleted_at'];

   public function project()
   {
      return $this->belongsTo(Project::class);
   }

   public function after_market_pricing_history()
   {
      return $this->hasMany(AfterMarketPricingHistory::class);
   }

   public static function postAfterMarket($createAfterMarketRequest)
   {
      $path = storage_path() . '/uploads/projects/';
      if(! $request->hasFile('scanned_file') ) {
         $scannedAftermarket = "<N/A>";
      } else {
         $file = $createAfterMarketRequest->file('scanned_file');
         $file->move($path, $file->getClientOriginalName());
         $scannedAftermarket = $path . $file->getClientOriginalName();
      }

      $after_market = new AfterMarket();
      $after_market->name = strtoupper($createAfterMarketRequest->get('name'));
      $after_market->model = strtoupper($createAfterMarketRequest->get('model'));
      $after_market->part_number = strtoupper($createAfterMarketRequest->get('part_number'));
      $after_market->reference_number = strtoupper($createAfterMarketRequest->get('reference_number'));
      $after_market->material_number = strtoupper($createAfterMarketRequest->get('material_number'));
      $after_market->serial_number = strtoupper($createAfterMarketRequest->get('serial_number'));
      $after_market->tag_number = strtoupper($createAfterMarketRequest->get('tag_number'));
      $after_market->drawing_number = strtoupper($createAfterMarketRequest->get('drawing_number'));
      $after_market->ccn_number = strtoupper($createAfterMarketRequest->get('ccn_number'));
      $after_market->company_name = strtoupper($createAfterMarketRequest->get('company_name'));
      $after_market->scanned_file = $scannedAftermarket;

      if($after_market->save()) {
         return redirect()->back()->with('message', 'You have successfully added AfterMarket "' . $after_market->name . '".');
      }
   }

   public static function addAfterMarketPricingHistory($createAfterMarketPricingHistoryRequest, $afterMarket)
   {
      $aftermarket_pricing_history = new AfterMarketPricingHistory();
      $aftermarket_pricing_history->after_market_id = $afterMarket->id;
      $aftermarket_pricing_history->po_number = trim($createAfterMarketPricingHistoryRequest->get('po_number'));
      $aftermarket_pricing_history->pricing_date = trim($createAfterMarketPricingHistoryRequest->get('pricing_date'));
      $aftermarket_pricing_history->price = trim(str_replace(',', '', $createAfterMarketPricingHistoryRequest->get('price')));
      $aftermarket_pricing_history->terms = trim(strtoupper($createAfterMarketPricingHistoryRequest->get('terms')));
      $aftermarket_pricing_history->delivery = trim($createAfterMarketPricingHistoryRequest->get('delivery'));
      $aftermarket_pricing_history->fpd_reference = trim(strtoupper($createAfterMarketPricingHistoryRequest->get('fpd_reference')));
      $aftermarket_pricing_history->wpc_reference = trim(strtoupper($createAfterMarketPricingHistoryRequest->get('wpc_reference')));

      if($aftermarket_pricing_history->save()) {
         return redirect()->back()->with('message', 'Pricing History for AfterMarket "'.$afterMarket->name.'" was successfully saved.');
      }
   }

}
