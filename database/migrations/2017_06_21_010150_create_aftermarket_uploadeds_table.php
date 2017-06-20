<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAftermarketUploadedsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('aftermarket_uploadeds', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('aftermarket_id')->unsigned();
         $table->string('original_filename')->unique();
         $table->string('filepath');
         $table->string('file_type');
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
      Schema::drop('aftermarket_uploadeds');
   }
}
