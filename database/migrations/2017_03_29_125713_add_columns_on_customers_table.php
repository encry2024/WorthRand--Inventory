<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnCustomersTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('customers', function (Blueprint $table) {
         $table->string('plant_site_address');
         $table->string('contact_person');
         $table->string('position_of_contact_person');
         $table->string('contact_number');
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
