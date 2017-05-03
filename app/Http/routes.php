<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
	return view('index');
});

$app->group(['prefix' => 'user/create', 'namespace' => 'App\Http\Controllers'], function($app) {

	// ex : {"lastname":"Lastennet", "firstname":"Loic", "nCarte":"xxxxxxxxxx", "password":"xxxxxxxxxx"}
	$app->post('/', 'UtilisateurController@create');

});

/*
* Utilisateur
 */
$app->group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://genius.cap/user -> Visualiser l'utilisateur
	$app->get('/', 'UtilisateurController@index');
	// http://genius.cap/user/10 -> Visualiser l'utilisateur en rapport à son ID
	$app->get('{id}', 'UtilisateurController@find');
	
	// http://genius.cap/user/update -> Modifier l'utilisateur
	$app->put('/update', 'UtilisateurController@update');
	$app->put('/', 'UtilisateurController@update');
	// Modifier le mot de passe
	$app->put('/update/password', 'UtilisateurController@updatePass');
	// http://genius.cap/user/delete -> Supprime l'utilisateur
	$app->delete('/delete', 'UtilisateurController@delete');
	$app->delete('/', 'UtilisateurController@delete');

});

$app->group(['prefix' => 'users', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://genius.cap/users -> Visualiser tous les utilisateurs
	$app->get('/', 'UtilisateurController@all');

});

/*
* Capsules
 */
$app->group(['prefix' => 'capsules', 'namespace' => 'App\Http\Controllers'], function($app) {

	$app->get('/left', 'CapsuleController@index1');
	$app->get('/right', 'CapsuleController@index2');

	$app->post('/', 'CapsuleController@updateOrCreate');
	$app->put('/', 'CapsuleController@updateOrCreate');

	$app->post('/', 'CapsuleController@typeCapsule');

	// Une capsule est prise
	$app->post('/take', 'CapsuleController@take');

});
