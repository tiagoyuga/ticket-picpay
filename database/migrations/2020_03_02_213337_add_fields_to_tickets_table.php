<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        #dd(config('constants'));
        Schema::table('tickets', function (Blueprint $table) {

            #$table->enum('payment_status', ['Paid', 'Not paid'])->default('Not paid');
            $table->enum('payment_status', config('constants.payment_status'))->default(config('constants.payment_status')[0]);
            $table->date('payment_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('payment_status');
            $table->dropColumn('payment_date');
        });
    }
}
