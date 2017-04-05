<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUserTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('customer_user', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('user_id');
         $table->integer('customer_id');
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('customer_user');
   }
}
