<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAftermarketUploadedsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::rename('aftermarket_uploadeds', 'aftermarket_uploads');
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
