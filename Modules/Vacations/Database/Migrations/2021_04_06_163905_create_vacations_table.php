<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('reason')->nullable();
            $table->string('start_date')->nullable();

            $table->float('paid_leave', 8, 1)->default(0);
            $table->float('unpaid_leave', 8, 1)->default(0);

            $table->string('end_date')->nullable();
            $table->float('days', 8, 2)->nullable();

            $table->enum('status', ['P', 'A','R'])->comment('where P=pending and A=approved and R=reject');
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
        Schema::dropIfExists('vacations');
    }
}
