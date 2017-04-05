<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnProjectsAftermarketSealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->string('scanned_file');
        });

        Schema::table('after_markets', function(Blueprint $table) {
            $table->string('scanned_file');
        });

        Schema::table('seals', function(Blueprint $table) {
            $table->string('scanned_file');
        });
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
