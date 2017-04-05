<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('projects', function (Blueprint $table) {
         $table->string('address');
         $table->string('contact_person');
         $table->string('consultant');
         $table->string('epc');
         $table->string('vendors');
         $table->string('epc_award');
         $table->date('implementation_date');
         $table->string('bu');
         $table->string('status');
         $table->string('final_result');
         $table->string('value');
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::table('projects', function (Blueprint $table) {
         //
      });
   }
}
