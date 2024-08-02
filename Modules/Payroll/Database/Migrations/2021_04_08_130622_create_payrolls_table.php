<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasTable('payrolls')){
            Schema::create('payrolls', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('working_days')->nullable();

                $table->bigInteger('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                
                $table->float('paid_leave',8,1)->nullable();
                $table->float('unpaid_leave',8,1)->nullable();

                $table->bigInteger('basic_salary')->nullable();

                $table->bigInteger('house_rent_allowance')->nullable();
                $table->bigInteger('convenyance_allowance')->nullable();

                $table->bigInteger('medical_allowance')->nullable();
                $table->bigInteger('skill_allowance')->nullable();

                $table->bigInteger('bonus')->nullable();
                $table->bigInteger('provident_fund')->nullable();

                $table->bigInteger('pf_arrear')->nullable();
                $table->bigInteger('esi')->nullable();
                
                $table->bigInteger('leave_deduction')->nullable();
                
                $table->bigInteger('esic_arrear')->nullable();
                $table->bigInteger('tds')->nullable();

                $table->bigInteger('loan_deduction')->nullable();
                $table->bigInteger('incomplete_working_hours')->nullable();

                $table->bigInteger('uninformed_leave_deduction')->nullable();
                $table->bigInteger('other_deduction')->nullable();

                $table->bigInteger('gross_salary')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
