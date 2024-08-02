<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->comment('user_id of who is created task');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('project_id')->unsigned()->index();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->bigInteger('assigned_to')->unsigned()->index();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('title')->nullable();
            $table->text('specification')->nullable();

            $table->string('create_date')->nullable();
            $table->string('deadline')->nullable();

            $table->timestamp('start_date_time')->nullable();
            $table->timestamp('stop_date_time')->nullable();

            $table->enum('status', ['S', 'F','O'])->comment('where O= on going, F= finished, S= stopped');

            $table->float('duration')->nullable();

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
        Schema::dropIfExists('tasks');
    }
}
