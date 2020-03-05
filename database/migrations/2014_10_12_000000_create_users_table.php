<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('email')->nullable();

            $table->string('email')->nullable();

            $table->string('additional_email')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string('phone1', 15)->nullable();
            $table->string('phone2', 15)->nullable();

            $table->boolean('is_dev')->default(false);
            $table->integer('access')->default(0);
            $table->dateTime('last_login')->nullable();

            $table->string('job_title')->nullable();
            $table->string('branch_location')->nullable();


            include('i-creators-data.php');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
