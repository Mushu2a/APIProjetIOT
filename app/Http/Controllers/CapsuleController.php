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
		$auth = Auth::user();
		// $capsule = Capsule::where('typeCapsule', '1')->get();

		return response()->json(["HOP" => $auth]);
	}

	public function index2() {
		$capsule = Capsule::where('typeCapsule', '2')->get();

		return response()->json([""]);
	}

	/**
	 * Enlève une capsule dans le nombre de capsule de l'utilisateur et nombre de capsule dans la table capsule.
	 *
	 * @param Request POST
	 * @return 
	 */
	public function take($id) {
		$auth = Auth::user();
		$capsule = Capsule::find($id);
		$typeCapsule = Booking::where('path_id', $path->id)->where('user_id', $auth->id)->get();

		if ($book->isEmpty()) {
			if ($path->bookingSeats < $path->remainingSeats) {
				$taking = Booking::create([
					'user_id' => $auth->id,
					'path_id' => $id
				]);

				// Met à jour le nombre de siège disponible
				$path->bookingSeats = $path->bookingSeats + 1;
				$updated = $path->save();
			} else {
				$taking = "You can't take this capsule ";
			}
		} else {
			$taking = "You have not permisions";
		}

		return response()->json(['taking' => $taking]);
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
				'numbers' => $request->numeric,
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