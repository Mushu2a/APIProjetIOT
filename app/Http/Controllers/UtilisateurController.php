<?php

namespace App\Http\Controllers;
use Auth;
use App\Utilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurController extends Controller {

	public function index() {
		$auth = Auth::user();
		$utilisateur = Utilisateur::find($auth->idutilisateur);

		return response()->json($utilisateur);
	}

	public function find($id) {
		$utilisateur = Utilisateur::find($id);

		return response()->json($utilisateur);
	}

	public function all() {
		$array = array("email", "lastname", "firstname", "nCarte" ,"created_at");
		$utilisateur = Utilisateur::all($array);

		return response()->json($utilisateur);
	}

	public function create(Request $request) {
		$this->validate($request, [
			'lastname' => 'required|unique:Utilisateurs,lastname',
			'firstname' => 'required|unique:Utilisateurs,firstname',
			'nCarte' => 'required'
		]);

		$utilisateur = Utilisateur::create([
			'email' => substr($request->lastname, 0, 1).'.'.$request->lastname.'@geniuscap.fr',
			'lastname' => ucfirst($request->lastname),
			'firstname' => ucfirst($request->firstname),
			'nCarte' => ucfirst($request->nCarte),
			'nCarteHash' => app('hash')->make($request->nCarte)
		]);

		return response()->json(['created' => $utilisateur]);
	}

	public function update(Request $request) {
		$auth = Auth::Utilisateur();
		$utilisateur = Utilisateur::find($auth->idutilisateur);

		$request->offsetUnset('password');
		$request->offsetUnset('nCarteHash');
		$updated = $utilisateur->update($request->all());

		return response()->json(['updated' => $updated]);
	}

	public function updatePass(Request $request) {
		$auth = Auth::Utilisateur();
		$utilisateur = Utilisateur::find($auth->id);

		$this->validate($request, [
			'password' => 'required'
		]);

		if (isset($request->password) != '') {
			$utilisateur->password = app('hash')->make($request->password);
			$updated = $utilisateur->save();
		}

		return response()->json(['updated' => $updated]);
	}

	public function delete(Request $request) {
		$auth = Auth::Utilisateur();
		$count = Utilisateur::destroy($auth->id);

		return response()->json(['deleted' => $count == 1]);
	}
}

?>