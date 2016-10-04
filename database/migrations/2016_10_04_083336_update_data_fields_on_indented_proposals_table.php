<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDataFieldsOnIndentedProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indented_proposals', function (Blueprint $table) {
            $table->renameColumn('terms_of_payment', 'terms_of_payment_1');
            $table->renameColumn('bank_details', 'bank_detail_name');
        });

        Schema::table('indented_proposals', function (Blueprint $table) {
            $table->string('terms_of_payment_address');
            $table->string('bank_detail_address');
            $table->string('bank_detail_account_no');
            $table->string('bank_detail_swift_code');
            $table->string('bank_detail_account_name');

            $table->string('commission_note');
            $table->string('commission_address');
            $table->string('commission_account_number');
            $table->string('commission_swift_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indented_proposals', function (Blueprint $table) {
            $table->dropColumn('terms_of_payment_1');
            $table->dropColumn('terms_of_payment_address');

            $table->dropColumn('bank_detail_address');
            $table->dropColumn('bank_detail_account_no');
            $table->dropColumn('bank_detail_swift_code');
            $table->dropColumn('bank_detail_account_name');

            $table->dropColumn('commission_note');
            $table->dropColumn('commission_address');
            $table->dropColumn('commission_account_number');
            $table->dropColumn('commission_swift_code');
        });
    }
}
