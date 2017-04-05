<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPricingHistory extends Model
{
   //

   public function project()
   {
      return $this->belongsTo(ProjectPricingHistory::class);
   }
}
