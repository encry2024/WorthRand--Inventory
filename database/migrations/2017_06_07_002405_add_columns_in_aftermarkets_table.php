<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInAftermarketsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('after_markets', function (Blueprint $table) {
         $table->string('description');
         $table->string('stock_number');
         $table->string('sap_number');
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::table('after_markets', function (Blueprint $table) {
         //
      });
   }
}
