<?php

use App\Models\Movement;
use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder {
	public function run() {
		DB::table('movements')->delete();

		Movement::create([
			'slug' => 'backflip',
			'name' => 'Backflip',
			'video_id' => '1',
		]);
	}
}