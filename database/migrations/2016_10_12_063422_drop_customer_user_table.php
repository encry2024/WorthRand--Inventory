<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCustomerUserTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::dropIfExists('customer_user');
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
