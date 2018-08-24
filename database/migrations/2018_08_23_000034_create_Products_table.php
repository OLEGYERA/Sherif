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
			$table->float('EUR', 10, 0)->nullable();
			$table->float('USD', 10, 0)->nullable();
			$table->float('UAH', 10, 0)->nullable();
			$table->integer('profitability')->nullable();
			$table->string('color', 191)->nullable();
			$table->string('manufacturer', 191)->nullable();
			$table->timestamps();
			$table->string('URL', 191)->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('publication')->nullable();
			$table->text('characteristics', 65535)->nullable();
			$table->integer('price_final')->nullable();
			$table->string('currency_final', 191)->nullable();
			$table->integer('status')->nullable();
			$table->integer('label')->nullable();
			$table->string('code', 191)->nullable();
			$table->integer('sale_discount')->nullable();
			$table->float('sale_price', 10, 0)->nullable();
            $table->string('mainimage', 191)->nullable();
            $table->string('addimage', 1024)->nullable();
            $table->string('concomitant', 1024)->nullable();
			$table->string('similar', 1024)->nullable();
			$table->string('maincategory', 255)->nullable();

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
