<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSealTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('seal', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('project_id');
         $table->string('name');
         $table->string('drawing_number');
         $table->string('bom_number');
         $table->string('end_user');
         $table->string('seal_type');
         $table->string('size');
         $table->string('material_code');
         $table->string('code');
         $table->string('model');
         $table->string('serial_number');
         $table->string('tag');
         $table->decimal('price', 19, 2);
         $table->softDeletes();
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
      Schema::drop('seal');
   }
}
