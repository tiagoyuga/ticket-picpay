<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name')->nullable()->index('index_groups_on_name');
			$table->integer('kind')->default(0);
			$table->integer('users_count')->default(0);
			$table->boolean('view_users')->default(0);
			$table->boolean('view_groups')->default(0);
			$table->boolean('view_links')->default(0);
			$table->boolean('view_daily_hours')->default(0);
			$table->boolean('view_adverts')->default(0);
			$table->boolean('view_clients')->default(0);
			$table->boolean('view_projects')->default(0);
			$table->boolean('view_invoices')->default(0);
			$table->boolean('view_daily_activities')->default(0);
			$table->boolean('view_quotes')->default(0);
			$table->boolean('view_tasks')->default(0);
			$table->boolean('view_business_dev')->default(0);
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
		Schema::drop('groups');
	}

}
