<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('slug', 191)->nullable();
			$table->string('vendor_code', 191)->nullable();
			$table->string('category', 191)->nullable();
			$table->float('price_eur', 10, 0)->nullable();
			$table->float('price_usd', 10, 0)->nullable();
			$table->float('price_uah', 10, 0)->nullable();
			$table->integer('profitability')->unsigned()->nullable();
			$table->string('color', 191)->nullable();
			$table->string('manufacturer', 191)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Products');
	}

}
