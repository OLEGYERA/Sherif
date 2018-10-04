<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductConcomitantSubcategoryPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_concomitant_subcategory_pivot', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->nullable();
			$table->integer('subcategory_id')->nullable();
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
		Schema::drop('product_concomitant_subcategory_pivot');
	}

}
