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
			$table->string('name');
			$table->string('video_id');
			$table->string('img_id');
			$table->string('gif_id');
			$table->string('discipline_id');
			$table->string('equals');
			$table->string('category');
			$table->string('info');
			$table->string('mistakes');
			$table->string('technique');
			$table->string('requirements');
			$table->string('progressions');
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
