<?php

use App\Models\Movement;
use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder {
	public function run() {
		DB::table('movements')->delete();

		Movement::create([
			'discipline_id' => '1',
			'slug' => 'gato',
			'category_id' => '',
			'name' => 'Gato',
			'name_variants' => json_encode(["Monkey", "Kong"]),
			'equals' => '',
			'tags' => 'Urbano,Obstáculos',
			'history' => 'El gato es un movimiento originado en la época de la inquisición y su inventor fue Pocholo.
Últimamente los veganos están manifestándose globalmente contra la crueldad animal ejercida en el parkour con este movimiento.',
			'technique_description_text' => 'El gato, tambien llamado monkey o kong es un salto en el que franquearemos un obstáculo apoyándonos en él con las manos en paralelo durante el salto, para después pasar las piernas juntas y flexionadas entre el hueco que dejan los brazos en su apoyo en el obstáculo.',
		]);

		Movement::create([
			'discipline_id' => '2',
			'slug' => 'backflip',
			'name' => 'Backflip',
			'name_variants' => json_encode(["monkey", "kong"]),
			'video_id' => '1',
		]);

		Movement::create([
			'discipline_id' => '3',
			'slug' => 'frontkick',
			'name' => 'Front kick',
			'name_variants' => json_encode(["monkey", "kong"]),
			'video_id' => '1',
		]);
	}
}