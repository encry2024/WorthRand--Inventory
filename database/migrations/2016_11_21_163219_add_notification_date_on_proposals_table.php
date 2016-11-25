<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationDateOnProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_and_sell_proposal_item', function(Blueprint $table) {
            $table->string('notification_date');
        });

        Schema::table('indented_proposal_item', function(Blueprint $table) {
            $table->string('notification_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_and_sell_proposal_item', function(Blueprint $table) {
            $table->dropColumn('notification_date');
        });

        Schema::table('indented_proposal_item', function(Blueprint $table) {
            $table->dropColumn('notification_date');
        });
    }
}
