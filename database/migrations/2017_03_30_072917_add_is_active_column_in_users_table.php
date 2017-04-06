<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveColumnInUsersTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('users', function (Blueprint $table) {
         $table->boolean('is_active')->default(true);
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