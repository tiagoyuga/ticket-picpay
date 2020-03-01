<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_activities', function(Blueprint $table)
		{
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->bigInteger('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('restrict');

            $table->text('activity');
            $table->text('before');
            $table->text('after');

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
		Schema::drop('ticket_status');
	}

}
