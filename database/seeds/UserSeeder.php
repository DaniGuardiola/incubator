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
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Dani Guardiola',
			'email' => 'dani@email.com',
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Dani Guardiola',
			'email' => 'dani@email.com',
			'password' => Hash::make('hotelcalifornia'),
		]);

		User::create([
			'name' => 'Dani Guardiola',
			'email' => 'dani@email.com',
			'password' => Hash::make('hotelcalifornia'),
		]);
	}
}