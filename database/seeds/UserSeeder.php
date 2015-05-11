<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create([
			'name' => 'Dani',
			'email' => 'dani@email.com',
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Fer',
			'email' => 'fer@email.com',
			'password' => Hash::make('deint4n17u'),
		]);

		User::create([
			'name' => 'Max',
			'email' => 'maxiniesta@email.com',
			'password' => Hash::make('650507977'),
		]);

		User::create([
			'name' => 'Suso',
			'email' => 'susodubdub@email.com',
			'password' => Hash::make('triplepiru'),
		]);

		User::create([
			'name' => 'Yeray',
			'email' => 'yerayayala@email.com',
			'password' => Hash::make('thetroders'),
		]);

		User::create([
			'name' => 'Andrew',
			'email' => 'handru@email.com',
			'password' => Hash::make('doblecork'),
		]);

		User::create([
			'name' => 'Jesus',
			'email' => 'jesusst@email.com',
			'password' => Hash::make('somersault'),
		]);

		User::create([
			'name' => 'Dani Guardiola',
			'email' => 'dani@email.com',
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Maroto',
			'email' => 'maroto3r@email.com',
			'password' => Hash::make('rata123'),
		]);

		User::create([
			'name' => 'Javi',
			'email' => 'trazdv@email.com',
			'password' => Hash::make('chiwaca'),
		]);
	}
}