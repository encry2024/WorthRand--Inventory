<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadSealsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('upload_seals', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('seal_id')->unsigned();
         $table->string('original_filename');
         $table->string('filepath');
         $table->string('file_type');
         $table->timestamps();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('upload_seals');
   }
}
