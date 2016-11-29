<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBranchIdOnIndentedAndBuyAndSellProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indented_proposals', function(Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('buy_and_sell_proposals', function(Blueprint $table) {
            $table->dropColumn('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indented_proposals', function(Blueprint $table) {
            $table->integer('branch_id');
        });

        Schema::table('buy_and_sell_proposals', function(Blueprint $table) {
            $table->integer('branch_id');
        });
    }
}
