<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepaymentSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('repayment_schedules')) {
            Schema::create('repayment_schedules', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('loan_id');
                $table->unsignedInteger('payment_no');
                $table->datetime('date');
                $table->decimal('payment_amount', 21, 6);
                $table->decimal('principal', 21, 6);
                $table->decimal('interest', 21, 6);
                $table->decimal('balance', 21, 6);
                $table->datetime('created_at');
                $table->datetime('updated_at');

                $table->foreign('loan_id')->references('id')->on('loans');
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
        //
        Schema::dropIfExists('repayment_schedules');
    }
}
