<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SealPricingHistory extends Model
{
    //
    public static function postSealPricingHistory($createPricingHistoryForSeal, $seal)
    {
        $sealPricingHistory = new SealPricingHistory();
        $sealPricingHistory->seal_id = $seal->id;
        $sealPricingHistory->po_number = $createPricingHistoryForSeal->get('po_number');
        $sealPricingHistory->pricing_date = $createPricingHistoryForSeal->get('pricing_date');
        $sealPricingHistory->price = $createPricingHistoryForSeal->get('price');
        $sealPricingHistory->terms = $createPricingHistoryForSeal->get('terms');
        $sealPricingHistory->delivery = $createPricingHistoryForSeal->get('delivery');
        $sealPricingHistory->fpd_reference = $createPricingHistoryForSeal->get('fpd_reference');
        $sealPricingHistory->wpc_reference = $createPricingHistoryForSeal->get('wpc_reference');

        if($sealPricingHistory->save()) {
            $seal->update(['price' => $sealPricingHistory->price]);

            return redirect()->back()->with('alert-type', 'success')->with('alert-icon', 'fa-check')
                ->with('message', 'You have successfully updated ' . $seal->name . ' \'s pricing history ');
        }

        return redirect()->back()->with('alert-type', 'danger')->with('alert-icon', 'fa-remove')
            ->with('message', $seal->name . ' \'s pricing history update was not successful. Please check your inputs');
    }
}
