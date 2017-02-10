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
        $sealPricingHistory->po_number = trim(strtoupper($createPricingHistoryForSeal->get('po_number')));
        $sealPricingHistory->pricing_date = trim(strtoupper($createPricingHistoryForSeal->get('pricing_date')));
        $sealPricingHistory->price = str_replace(',', '', trim(strtoupper($createPricingHistoryForSeal->get('price'))));
        $sealPricingHistory->terms = trim(strtoupper($createPricingHistoryForSeal->get('terms')));
        $sealPricingHistory->delivery = trim(strtoupper($createPricingHistoryForSeal->get('delivery')));
        $sealPricingHistory->fpd_reference = trim(strtoupper($createPricingHistoryForSeal->get('fpd_reference')));
        $sealPricingHistory->wpc_reference = trim(strtoupper($createPricingHistoryForSeal->get('wpc_reference')));

        if($sealPricingHistory->save()) {
            $seal->update(['price' => $sealPricingHistory->price]);

            return redirect()->back()->with('alert-type', 'success')->with('alert-icon', 'fa-check')
                ->with('message', 'You have successfully updated ' . $seal->name . ' \'s pricing history ');
        }

        return redirect()->back()->with('alert-type', 'danger')->with('alert-icon', 'fa-remove')
            ->with('message', $seal->name . ' \'s pricing history update was not successful. Please check your inputs');
    }
}
