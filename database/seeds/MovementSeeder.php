<?php

use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder {
	public function run() {
		DB::table('movements')->delete();
	}
}