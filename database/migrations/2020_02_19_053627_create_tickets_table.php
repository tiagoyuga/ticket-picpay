<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('restrict');

            $table->bigInteger('cto_id')->unsigned()->nullable();
            $table->foreign('cto_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->bigInteger('dev_id')->unsigned()->nullable();
            $table->foreign('dev_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->bigInteger('ticket_status_id')->unsigned();
            $table->foreign('ticket_status_id')
                ->references('id')
                ->on('ticket_status')
                ->onDelete('restrict');
            $table->string('uid');
            $table->string('subject');
            $table->text('content');

            $table->string('dev_estimated_time')->nullable();
            $table->string('cto_hours')->nullable();
            $table->string('dev_hour_spent')->nullable();

            $table->enum('priority', array_keys(config('enums.priorities')))->nullable();

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
		Schema::drop('tickets');
	}

}
