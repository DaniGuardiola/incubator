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

	public function getMovement($id, $discipline_id) {
		if ($id === "new") {
			$movement = new Movement;
			$movement->discipline_id = $discipline_id;
			$allnew = Movement::where("slug", "LIKE", "nuevo-movimiento%")->get();
			//\Log::debug(print_r($allnew, true));
			$numbers = [];
			foreach ($allnew as $key => $value) {
				$numbers[] = (int) substr($value->slug, 17);
			}
			\Log::debug("NUMBERS: " . print_r($numbers, true));
			$lastone = count($numbers) > 0 ? max($numbers) : 0;
			$lastone = $lastone ?: 0;
			$movement->slug = "nuevo-movimiento-" . ($lastone + 1);
			$movement->name = "Nuevo movimiento " . ($lastone + 1);
			$movement->steps = '[""]';
			$movement->advice = '[""]';
			$movement->progressions = '[""]';
			$movement->save();
		} else {
			$movement = $this->getData($id);
		}
		$args = [
			"movement" => $movement,
		];
		return \View::make("movement")->with($args);
	}

	public function getRemoveMovement($id) {
		$movement = Movement::find($id);
		$movement->delete();
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
			"name_variants" => json_encode(explode(",", $rawData["name_variants"])),
			"equals" => json_encode(array_map('intval', array_filter(explode(",", $rawData["equals"])))),
			"tags" => json_encode(explode(",", $rawData["tags"])),
			"history" => $rawData["history"],
			"technique_description_text" => $rawData["technique_description_text"],
			"steps" => json_encode(explode("|", $rawData["steps"])),
			"advice" => json_encode(explode("|", $rawData["advice"])),
			"progressions" => json_encode(explode("|", $rawData["progressions"])),
			"requirements" => json_encode(array_map('intval', array_filter(explode(",", $rawData["requirements"])))),
			"derived_from" => json_encode(array_map('intval', array_filter(explode(",", $rawData["derived_from"])))),
			"variations" => json_encode(array_map('intval', array_filter(explode(",", $rawData["variations"])))),
		];
		\Log::debug(print_r($data, true));

		\Log::debug(print_r($movement, true));
		$movement->fill($data);
		$movement->save();
		\Log::debug(print_r($movement, true));
	}

}
