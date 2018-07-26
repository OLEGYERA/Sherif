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
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('vendor_code')->nullable();
			$table->string('category')->nullable();
			$table->float('price_eur', 10, 0)->nullable();
			$table->float('price_usd', 10, 0)->nullable();
			$table->float('price_uah', 10, 0)->nullable();
			$table->integer('profitability')->unsigned()->nullable();
			$table->string('color')->nullable();
			$table->string('manufacturer')->nullable();
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
