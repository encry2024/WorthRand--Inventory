<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPolymorphColumnOnIndentedProposalItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indented_proposal_item', function (Blueprint $table) {
            $table->dropColumn('indented_proposal_itemable_id');
            $table->dropColumn('indented_proposal_itemable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indented_proposal_item', function (Blueprint $table) {
            $table->integer('indented_proposal_itemable_id');
            $table->string('indented_proposal_itemable_type');
        });
    }
}
