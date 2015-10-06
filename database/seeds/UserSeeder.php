<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create([
			'name' => 'Dani',
			'status' => 'god',
			'email' => 'dani@email.com',
			'username' => 'dani',
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Fer',
			'status' => 'god',
			'email' => 'fer@email.com',
			'password' => Hash::make('deint4n17u'),
		]);

		User::create([
			'name' => 'Juan',
			'status' => 'god',
			'email' => 'mrtraceur@email.com',
			'password' => Hash::make('do1backflip!'),
		]);

		User::create([
			'name' => 'Phosky',
			'status' => 'vip',
			'email' => 'phosky@email.com',
			'password' => Hash::make('guprocks'),
		]);

		User::create([
			'name' => 'Max',
			'status' => 'normal',
			'email' => 'maxiniesta@email.com',
			'password' => Hash::make('650507977'),
		]);

		User::create([
			'name' => 'Suso',
			'status' => 'normal',
			'email' => 'susodubdub@email.com',
			'password' => Hash::make('triplepiru'),
		]);

		User::create([
			'name' => 'Yeray',
			'status' => 'normal',
			'email' => 'yerayayala@email.com',
			'password' => Hash::make('thetroders'),
		]);

		User::create([
			'name' => 'Andrew',
			'status' => 'normal',
			'email' => 'handru@email.com',
			'password' => Hash::make('doblecork'),
		]);

		User::create([
			'name' => 'Jesus',
			'status' => 'normal',
			'email' => 'jesusst@email.com',
			'password' => Hash::make('somersault'),
		]);

		User::create([
			'name' => 'Maroto',
			'status' => 'normal',
			'email' => 'maroto3r@email.com',
			'password' => Hash::make('rata123'),
		]);

		User::create([
			'name' => 'Javi',
			'status' => 'normal',
			'email' => 'trazdv@email.com',
			'password' => Hash::make('chiwaca'),
		]);

		User::create([
			'name' => 'Alberto',
			'status' => 'normal',
			'email' => 'albertorres@email.com',
			'password' => Hash::make('shoder22'),
		]);

		User::create([
			'name' => 'Plaza',
			'status' => 'normal',
			'email' => 'danielplaza@email.com',
			'password' => Hash::make('contraseña'),
		]);

		User::create([
			'name' => 'Vento',
			'status' => 'normal',
			'email' => 'vento@email.com',
			'password' => Hash::make('vento01'),
		]);

		User::create([
			'name' => 'Jorge',
			'status' => 'normal',
			'email' => 'yorspk@email.com',
			'password' => Hash::make('jorgeparkour'),
		]);

		User::create([
			'name' => 'Piña',
			'status' => 'normal',
			'email' => 'pinatricking@email.com',
			'password' => Hash::make('615990051'),
		]);

		User::create([
			'name' => 'Danilon',
			'status' => 'normal',
			'email' => 'danilon@email.com',
			'password' => Hash::make('gazpacho'),
		]);

		User::create([
			'name' => 'Axel',
			'status' => 'normal',
			'email' => 'axeldupre@email.com',
			'password' => Hash::make('parkour'),
		]);
	}
}