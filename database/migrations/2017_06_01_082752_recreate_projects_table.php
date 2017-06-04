<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::dropIfExists('projects');

      Schema::create('projects', function(Blueprint $table) {
         $table->bigIncrements('id');

         $table->string('customer_id');
         $table->string('name');
         $table->string('project_terms');
         $table->string('source');
         $table->string('address_1');
         $table->string('contact_person_1');
         $table->string('contact_number_1');
         $table->string('email_1')->unique();

         $table->string('consultant');
         $table->string('address_2');
         $table->string('contact_person_2');
         $table->string('contact_number_2');
         $table->string('email_2')->unique();

         $table->string('shorted_list_epc');
         $table->string('address_3');
         $table->string('contact_person_3');
         $table->string('contact_number_3');
         $table->string('email_3')->unique();

         $table->string('approved_vendors_list');
         $table->string('requirement');
         $table->string('epc_award');
         $table->date('award_date');
         $table->date('implementation_date');
         $table->date('execution_date');

         $table->string('bu');
         $table->string('bu_reference');
         $table->string('wpc_reference');
         $table->string('affinity_reference');
         $table->string('value');
         $table->string('status');

         $table->string('reference_number')->unique();
         $table->string('drawing_number')->unique();
         $table->string('material_number')->unique();
         $table->string('serial_number')->unique();
         $table->string('tag_number')->unique();

         $table->string('epc');
         $table->string('vendors');
         $table->string('final_result');

         $table->string('scanned_file');
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

   }
}
