<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadedProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('uploaded_projects', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('project_id')->unsigned();
         $table->string('original_filename')->unique();
         $table->string('filepath');
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
      Schema::drop('uploaded_projects');
   }
}
