<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GeniusCap</title>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="header">
			<div class="contenu">
				<img src="geniusCap.png" alt="GeniusCap">
				<!--<object type="image/svg+xml" data="geniusCap.svg">
					Le navigateur ne supporte pas les fichiers SVG !
				</object>-->
				<p>GeniusCap : Bienvenue à vous !<br><br> <a href="#documentation">Documentation &#9749;</a> | <a href="https://twitter.com/Mushu2a" target="_blank">@Mushu2a &#9917;</a>.
				</p>
			</div>
		</div>

		<div id="documentation">
			<h2>Web API</h2>
			<h3>List API user example</h3>

			<div class="table-responsive-vertical ombre">
				<table id="table" class="table table-hover light-blue">
					<thead>
						<tr>
							<th>Method</th>
							<th>URL</th>
							<th>Controler@method</th>
							<th>Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-title="Method">GET</td>
							<td data-title="URL">http://geniuscap.esy.es/user</td>
							<td data-title="Controler@method">UserController@index</td>
							<td data-title="Information">User authenticate</td>
						</tr>
						<tr>
							<td data-title="Method">GET</td>
							<td data-title="URL">http://geniuscap.esy.es/user/{id}</td>
							<td data-title="Controler@method">UserController@find</td>
							<td data-title="Information">Fetch User by id</td>
						</tr>
						<tr>
							<td data-title="Method">POST</td>
							<td data-title="URL">http://geniuscap.esy.es/create</td>
							<td data-title="Controler@method">UserController@create</td>
							<td data-title="Information">Create a new User</td>
						</tr>
						<tr>
							<td data-title="Method">PUT</td>
							<td data-title="URL">http://geniuscap.esy.es/  or (update)</td>
							<td data-title="Controler@method">UserController@update</td>
							<td data-title="Information">Update User auth</td>
						</tr>
						<tr>
							<td data-title="Method">DELETE</td>
							<td data-title="URL">http://geniuscap.esy.es/  or (delete)</td>
							<td data-title="Controler@method">UserController@delete</td>
							<td data-title="Information">Delete User auth</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
