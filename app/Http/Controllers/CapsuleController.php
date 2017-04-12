<?php

namespace App\Http\Controllers;
use Auth;
use App\Admin;
use App\Capsule;
use App\typeCapsule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CapsuleController extends Controller {

	public function index1() {
		$capsule = Capsule::where('typeCapsule', '1')->get();

		return response()->json($capsule);
	}

	public function index2() {
		$capsule = Capsule::where('typeCapsule', '2')->get();

		return response()->json($capsule);
	}

	public function updateOrCreate(Request $request, $idcapsule) {
		$capsule = Capsule::where('idcapsule', $idcapsule)->first();

		if ($capsule) {
			$updateOrCreate = $capsule->update($request->all());
		} else {
			$this->validate($request, [
				'numbers' => 'required|integer'
			]);

			$updateOrCreate = Capsule::create([
				'libelle' => $request->libelle,
				'numbers' => $request->numbers,
			]);
		}

		return response()->json(['updateOrCreate' => $updateOrCreate]);
	}

	public function typeCapsule(Request $request) {
		$auth = Auth::Admin();

		if ($auth) {
			$this->validate($request, [
				'libelle' => 'integer'
			]);

			$create = typeCapsule::create([
				'libelle' => $request->libelle,
			]);

			return response()->json($create);
		}

		return null;
	}
}

?>