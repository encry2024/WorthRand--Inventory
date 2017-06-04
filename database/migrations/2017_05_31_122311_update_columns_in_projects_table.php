<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsInProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('projects', function (Blueprint $table) {
         $table->dropColumn('ccn_number');
         $table->dropColumn('model');
         $table->dropColumn('part_number');


         $table->string('contact_number');
         $table->string('email')->unique();
         $table->string('shorted_list_epc');
         $table->string('affinity_reference');
         $table->string('approved_vendors_list');
         $table->string('requirement');
         $table->date('execution_date');
         $table->string('source');
         $table->bigInteger('user_id');
         $table->string('terms');
         $table->date('award_Date');
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {

   }
}
