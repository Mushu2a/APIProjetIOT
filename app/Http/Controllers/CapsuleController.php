<?php

namespace App\Http\Controllers;
use Auth;
use App\Capsule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CapsuleController extends Controller {

	public function index1() {
		$score = Capsule::orderBy('score', 'DESC')->limit(5)->get();

		return response()->json($score);
	}

	public function index2() {
		$score = Capsule::orderBy('score', 'DESC')->limit(5)->get();

		return response()->json($score);
	}

	public function updateOrCreate(Request $request, $idcapsule) {
		$capsule = Capsule::where('idcapsule', $idcapsule)->orderBy('score', 'DESC')->first();

		if ($capsule) {
			$updateOrCreate = $capsule->update($request->all());
		} else {
			$this->validate($request, [
				'score' => 'required|integer'
			]);

			$updateOrCreate = Capsule::create([
				'user_id' => $auth->id,
				'username' => $auth->username,
				'score' => $request->score,
			]);
		}

		return response()->json(['updateOrCreate' => $updateOrCreate]);
	}
}

?>