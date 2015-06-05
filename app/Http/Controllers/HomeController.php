<?php namespace App\Http\Controllers;

use App\Models\Movement;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	 */

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index() {
		$all = [
			"parkour" => Movement::where("discipline_id", "=", 1)->get(),
			"streetstunts" => Movement::where("discipline_id", "=", 2)->get(),
			"tricking" => Movement::where("discipline_id", "=", 3)->get(),
		];
		$args = [
			"all" => $all,
		];
		return view('home')->with($args);
	}

	public function getData($id) {
		$movement = Movement::find($id);
		return $movement;
	}

	public function getMovement($id) {
		$movement = $this->getData($id);
		$args = [
			"movement" => $movement,
		];
		return View::make("movement")->with($args);
	}

}
