<?php

namespace App\Http\Controllers;
use Auth;
use App\EstPrise;
use App\Capsule;
use App\typeCapsule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CapsuleController extends Controller {

	public function index1() {
		$capsule = Capsule::where('typeCapsule', '1')->first();

		return response()->json(["position" => $capsule->libelle, "nombre(s)" => $capsule->numbers]);
	}

	public function index2() {
		$capsule = Capsule::where('typeCapsule', '2')->first();

		return response()->json(["position" => $capsule->libelle, "nombre(s)" => $capsule->numbers]);
	}

	/**
	 * Enlève une capsule dans le nombre de capsule de l'utilisateur et nombre de capsule dans la table capsule.
	 *
	 * @param Request POST
	 * @return 
	 */
	public function take($data) {
		$auth = Auth::user();
		$capsule = Capsule::where('libelle', $data)->first();

		if ($auth->nCapsule > 0 || $capsule->numbers > 0) {

			// Ajoute le capsule prise par l'utilisateur pour l'historique
			$take = EstPrise::create([
				'unUtilisateur' => $auth->idutilisateur,
				'uneCapsule' => $capsule->idcapsule
			]);

			// Met à jour le nombre de capsule de l'utilisateur
			$auth->nCapsule = $auth->nCapsule - 1;
			$updated = $auth->save();

			// Met à jour le nombre de capsule disponible
			$capsule->numbers = $capsule->numbers - 1;
			$updated = $capsule->save();

			$taken = "true";
		} else {
			$taken = "You can't take this capsule !";
		}

		return response()->json(['Caspule restante' => $auth->nCapsule, 'taken' => $taken]);
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