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

	public function guide() {
		return view('guide');
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
		return \View::make("movement")->with($args);
	}

	public function getList() {
		$movements = [
			"parkour" => Movement::where("discipline_id", "=", 1)->get(),
			"streetstunts" => Movement::where("discipline_id", "=", 2)->get(),
			"tricking" => Movement::where("discipline_id", "=", 3)->get(),
		];
		$args = [
			"movements" => $movements,
		];
		return \View::make("list")->with($args);
	}

	public function postSaveMovement($id) {
		$movement = $this->getData($id);
		$rawData = \Input::all();
		\Log::debug(print_r($rawData, true));

		$data = [
			"slug" => $rawData["slug"],
			"category_id" => $rawData["category_id"],
			"name" => $rawData["name"],
			"name_variants" => explode(",", $rawData["name_variants"]),
			"equals" => explode(",", $rawData["equals"]),
			"tags" => explode(",", $rawData["tags"]),
			"history" => $rawData["history"],
			"technique_description_text" => $rawData["technique_description_text"],
		];

		\Log::debug(print_r($data, true));
	}

}
