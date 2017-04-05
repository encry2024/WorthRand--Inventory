<?php

namespace App;

class Currency {

   const FROM_CURRENCY = "JPY";
   const TO_CURRENCY = "USD";

   public function currency($amount)
   {
      $fromCurrency = urlencode(self::FROM_CURRENCY);
      $toCurrency = urlencode(self::TO_CURRENCY);
      $encode_amount = $amount;
      $googleCurrencyAPI = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$fromCurrency&to=$toCurrency");
      $googleCurrencyAPI = explode("<span class=bld>", $googleCurrencyAPI);
      $googleCurrencyAPI = explode("</span>", $googleCurrencyAPI[1]);
      $converted_currency = preg_replace("/[^0-9\.]/", null, $googleCurrencyAPI[0]);
      
      return $converted_currency;
   }
}
