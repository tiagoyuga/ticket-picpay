<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->bigIncrements('id');
		    $table->string('company_name')->nullable();
			$table->string('contact_name')->nullable();
			$table->string('cell_phone')->nullable();
			$table->string('additional_phone')->nullable();
			$table->string('email')->nullable();

			$table->string('additional_email')->nullable();
			$table->string('address')->nullable();
			$table->string('zip_code')->nullable();
			$table->string('state')->nullable();

			$table->float('cto_amount', 8, 2)->nullable();
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
		Schema::drop('clients');
	}

}
