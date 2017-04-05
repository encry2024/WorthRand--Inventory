<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetRevenue extends Model
{
   //
   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function target_revenue_history()
   {
      return $this->hasMany(TargetRevenueHistory::class);
   }

   public static function setTargetRevenue($request, $salesEngineer)
   {
      $targetRevenue = new TargetRevenue();
      $targetRevenue->user_id = $salesEngineer->id;
      $targetRevenue->target_sale = $request->get('target_sale');

      if($targetRevenue->save()) {
         return redirect()->back()->with('message', strtoupper($salesEngineer->name) . '\'s Target Revenue was successfully set.');
      }
   }
}
