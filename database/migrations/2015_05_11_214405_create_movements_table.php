<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('movements', function (Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->string('category_id');
			$table->string('name');
			$table->string('name_variants');
			$table->string('equals');
			$table->string('tags');
			$table->longText('history');
			$table->longText('technique_description_text');
			$table->string('steps');
			$table->string('advice');
			$table->string('progressions');
			$table->string('gif_id');
			$table->string('discipline_id');
			$table->string('info');
			$table->string('mistakes');
			$table->string('technique');
			$table->string('requirements');
			$table->string('derived_from');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('movements');
	}

}
