<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousEmployementHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_employement_histories', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('previous_company_name')->nullable();

            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_number')->nullable();

            $table->timestamp('previous_company_date_of_joining')->nullable();
            $table->timestamp('previous_company_date_of_relieving')->nullable();

            $table->string('experience_letter')->nullable();
            $table->string('relieving_letter')->nullable();

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
        Schema::dropIfExists('previous_employement_histories');
    }
}
