<?php
$table->biginteger('user_creator_id')->unsigned()->nullable();
$table->foreign('user_creator_id')->references('id')->on('users')->onDelete('restrict');
$table->biginteger('user_updater_id')->unsigned()->nullable();
$table->foreign('user_updater_id')->references('id')->on('users')->onDelete('restrict');
$table->biginteger('user_eraser_id')->unsigned()->nullable();
$table->foreign('user_eraser_id')->references('id')->on('users')->onDelete('restrict');
