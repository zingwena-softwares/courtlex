<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_cases', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('case_status');
            $table->string('case_title');
            $table->string('client_name');
            $table->string('case_subject')->nullable();
            $table->string('case_number');

            $table->string('resplawyer_name');
            $table->string('resplawyer_phone')->nullable();
            $table->string('resplawyer_email')->nullable();
            $table->string('resplawyer_lawfirmname')->nullable();
            $table->string('resplawyer_lawfirmcity')->nullable();
            $table->string('resplawyer_lawfirmaddress')->nullable();

            $table->string('court_name')->nullable();
            $table->string('court_city')->nullable();
            $table->string('nextcourt_date')->nullable();
            $table->string('notes')->nullable();
            $table->string('added_by')->nullable();

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
        Schema::dropIfExists('client_cases');
    }
}
