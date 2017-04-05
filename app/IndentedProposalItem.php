<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndentedProposalItem extends Model
{
   //
   protected $table = 'indented_proposal_item';

   protected $fillable =
   ['quantity', 'price', 'delivery', 'status'];

   public function project()
   {
      return $this->belongsTo(Project::class, 'item_id');
   }

   public function after_market()
   {
      return $this->belongsTo(AfterMarket::class, 'item_id');
   }


   public static function indentedProposalChangeItemNotifyMeDate($request, $indentedProposalItem)
   {
      $notification_date = $request->get('notify_me_after') * 7;
      $numberOfWeeks = $request->get('notify_me_after');
      $dateToday = date('Y-m-d');
      $formattedDate = date_create($dateToday);

      date_add($formattedDate, date_interval_create_from_date_string("$numberOfWeeks weeks"));
      $dateOfNotification = date_format($formattedDate, "Y-m-d");

      // echo($dateOfNotification);

      // $indentedProposalItem->update(['notify_me_after' => $notification_date, 'notification_date' => $dateOfNotification]);
      $indentedProposalItem->notify_me_after = $notification_date;
      $indentedProposalItem->notification_date = $dateOfNotification;

      if($indentedProposalItem->save()) {
         return redirect()->back()
         ->with('alert', 'alert-success')
         ->with('msg_icon', 'glyphicon glyphicon-pushpin')
         ->with('message', 'The System will notify you after ' . $numberOfWeeks . ' weeks ( ' . date('F d, Y', strtotime($dateOfNotification)) . ' ).');
      }
   }
}
