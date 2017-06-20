<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUploadedProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::rename('uploaded_projects', 'upload_projects');
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      //
   }
}
