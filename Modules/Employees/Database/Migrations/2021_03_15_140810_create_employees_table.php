<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('employee_name')->nullable();
            
            $table->string('primary_email')->nullable();
            $table->timestamp('date_of_birth')->nullable();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('father_husband_name')->nullable();
            $table->string('mobile_number')->nullable();

            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();

            $table->string('resume')->nullable();
            $table->string('photo')->nullable();

            $table->string('address_proof')->nullable();
            $table->string('pan_card')->nullable();

            $table->integer('hourly_rate')->nullable();
            $table->timestamp('date_of_joining')->nullable();

            $table->enum('gender', ['m','f','o'])->nullable();
            $table->string('notes')->nullable();

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
        Schema::dropIfExists('employees');
    }
}
