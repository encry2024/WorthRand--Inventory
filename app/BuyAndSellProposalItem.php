<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyAndSellProposalItem extends Model
{
    protected $table = 'buy_and_sell_proposal_item';
    protected $fillable = ['status', 'notify_me_after', 'notification_date'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'item_id');
    }

    public function after_market()
    {
        return $this->belongsTo(AfterMarket::class, 'item_id');
    }

    public static function buyAndSellProposalChangeItemNotifyMeDate($request, $buyAndSellProposalItem)
    {
        $notification_date = $request->get('notify_me_after') * 7;
        $numberOfWeeks = $request->get('notify_me_after');
        $dateToday = date('Y-m-d');
        $formattedDate = date_create($dateToday);

        date_add($formattedDate, date_interval_create_from_date_string("$numberOfWeeks weeks"));
        $dateOfNotification = date_format($formattedDate, "Y-m-d");

        // echo($dateOfNotification);

        // $buyAndSellProposalItem->update(['notify_me_after' => $notification_date, 'notification_date' => $dateOfNotification]);
        $buyAndSellProposalItem->notify_me_after = $notification_date;
        $buyAndSellProposalItem->notification_date = $dateOfNotification;

        if($buyAndSellProposalItem->save()) {
            return redirect()->back()
                ->with('alert', 'alert-success')
                ->with('msg_icon', 'glyphicon glyphicon-pushpin')
                ->with('message', 'The System will notify you after ' . $numberOfWeeks . ' weeks ( ' . date('F d, Y', strtotime($dateOfNotification)) . ' ).');
        }
    }


}
