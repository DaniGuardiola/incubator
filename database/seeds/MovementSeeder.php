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
			'steps' => json_encode([
				"Pon las piernas de forma que X",
				"Impúlsate hacia Y",
				"Tras Y, haz Z",
				"Para caer correctamente, extiende A",
				"Coloca tu cuerpo de forma B",
				"Máximo siempre 6 pasos",
				"<- Por que si no, pasa esto",
			]),
			'advice' => json_encode([
				"No te caigas que no tenemos seguro",
				"No es aconsejable saltar policías",
			]),
			'progressions' => json_encode([
				"Primero haz esto",
				"Y luego esto otro",
			]),
		]);

		Movement::create([
			'discipline_id' => '1',
			'slug' => 'pasavallas',
			'category_id' => '',
			'name' => 'Pasavallas',
			'name_variants' => json_encode([]),
			'equals' => '',
			'tags' => 'Urbano,Obstáculos',
			'history' => 'El pasavallas es un movimiento originado en la época de Mecano y su inventor fue Franco.',
			'technique_description_text' => 'El pasavallas es un salto en el que franquearemos un obstáculo apoyándonos en él con las manos en paralelo durante el salto, para después pasar las piernas juntas y flexionadas entre el hueco que dejan los brazos en su apoyo en el obstáculo.',
			'steps' => json_encode([
				"Pon las piernas de forma que X",
				"Impúlsate hacia Y",
				"Tras Y, haz Z",
				"Para caer correctamente, extiende A",
				"Coloca tu cuerpo de forma B",
				"Máximo siempre 6 pasos",
				"<- Por que si no, pasa esto",
			]),
			'advice' => json_encode([
				"No te caigas que no tenemos seguro",
				"No es aconsejable saltar policías",
			]),
			'progressions' => json_encode([
				"Primero haz esto",
				"Y luego esto otro",
			]),
		]);

		Movement::create([
			'discipline_id' => '2',
			'slug' => 'backflip',
			'name' => 'Backflip',
		]);

		Movement::create([
			'discipline_id' => '2',
			'slug' => 'frontflip',
			'name' => 'Frontflip',
		]);

		Movement::create([
			'discipline_id' => '3',
			'slug' => 'frontkick',
			'name' => 'Front kick',
		]);

		Movement::create([
			'discipline_id' => '3',
			'slug' => 'triple-piru',
			'name' => 'Triple piru',
		]);
	}
}