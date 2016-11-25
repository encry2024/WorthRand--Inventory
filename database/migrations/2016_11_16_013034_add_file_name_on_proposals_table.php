<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileNameOnProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indented_proposals', function(Blueprint $table) {
            $table->string('file_name');
        });

        Schema::table('buy_and_sell_proposals', function(Blueprint $table) {
            $table->string('file_name');
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
            $table->dropColumn('file_name');
        });

        Schema::table('buy_and_sell_proposals', function(Blueprint $table) {
            $table->dropColumn('file_name');
        });
    }
}
