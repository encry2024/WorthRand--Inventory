<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePricingDateOnSealPricingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seal_pricing_histories', function (Blueprint $table) {
            $table->integer('pricing_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seal_pricing_histories', function (Blueprint $table) {
            $table->date('pricing_date')->change();
        });
    }
}
