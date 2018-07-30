<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->nullable()->index('users_role_id_foreign');
			$table->string('name', 191);
			$table->string('email', 191)->unique();
			$table->string('avatar', 191)->nullable()->default('users/default.png');
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->text('settings', 65535)->nullable();
			$table->timestamps();
			$table->string('lastname', 191)->nullable();
			$table->string('phone', 32)->nullable();
			$table->text('cart', 65535)->nullable();
			$table->text('wishlist', 65535)->nullable();
			$table->boolean('status')->nullable();
			$table->string('ip', 40)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
