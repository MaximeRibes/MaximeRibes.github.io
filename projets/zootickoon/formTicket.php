<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Ticket Zoomania</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<form method="post" enctype="multipart/form-data" target="#finformulaire.html" action="./
			validationFormTicket.php">
	<h1>Support Zoomania</h1>

	<div class="container">

		<div class="formgroup">
			<label for="identifiant">Identifiant :</label>
			<input type="identifiant" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant">
		</div>

		<div class="formgroup">
			<label for="sujet">Sujet :</label>
			<input type="sujet" class="form-control" name="sujet" id="sujet" placeholder="Sujet">
		</div>

		<div class="form-group">
			<label for="description">Donnez une description de votre problème</label>
			<textarea type="description" name="description" class="form-control" id="description" rows="5" cols="50" placeholder="Decrivez votre problème"></textarea>
		</div>

 		<div class="form-group">
			<label for="priorité">Quelle est la priorité de votre problème ?</label>
			<select type="priorite" name="priorite" class="form-control" id="priorite">
				<option value="3">Très haute</option>
				<option value="2">Moyenne</option>
				<option value="1">Basse</option>
			</select>
		</div>

		<div class="form-group">
			<label for="secteur">Quel est le secteur du zoo ?</label>
			<select type="secteur" name="secteur" class="form-control" id="secteur">
				<option value="savane">Savane</option>
				<option value="marin">Marin</option>
				<option value="reptile">Reptile</option>
				<option value="polaire">Polaire</option>
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Envoyer</button>
	</div>
</body>
<!--
<!DOCTYPE html>
<html>

	<head>

		<title>Formulaire de demandes</title>
		<meta charset="utf-8">
		<link href="ticket.css" rel="stylesheet">

	</head>


	<body>

		<h1> Formulaire de tickets</h1>

			<div class="tran1">
			<form method="post" enctype="multipart/form-data" target="#finform1.html" action="./
			validationformTicket.php">
			<!--<input type="hidden" id="problematique" name="problematique" value="tout va bien">--

				<fieldset>

						<div class="champ">
							<input type="radio" id="standard" name="priority" value="standard">
							<label for="standard">Priorité standard</label>
							<input type="radio" id="urgent" name="priority" value="urgent">
							<label for="urgent">Priorité urgente</label>
							<input type="radio" id="tres-urgent" name="priority" value="tres-urgent">
							<label for="tres-urgent">Priorité très urgente</label>
						</div>
				</fieldset>

				<fieldset>

					<legend>Problèmes rencontrés :</legend>
						<div class="champ">
							<label for="subject">Sujet de l'incident :</label>
							<input type="text" id="subject" name="subject" minlength="2" maxlength="100" required>
						</div>
						<div class="champ">
							<input type="checkbox" id="secteur1" name="problemes" value="Secteur 1">
							<label for="secteur1">Secteur 1</label>
							<input type="checkbox" id="secteur2" name="problemes" value="Secteur 2">
							<label for="secteur2">Secteur 2</label>
							<input type="checkbox" id="secteur3" name="problemes" value="Secteur 3">
							<label for="secteur3">Secteur 3</label>
							<input type="checkbox" id="secteur4" name="problemes" value="Secteur 4">
							<label for="secteur4">Secteur 4</label>
							<input type="checkbox" id="secteur5" name="problemes" value="Secteur 5">
					 		<label for="secteur5">Secteur 5</label>
						</div>
						<div class="champ">
							<textarea name="description" placeholder="Description du ou des problèmes rencontrés" maxlength="500"></textarea>
						</div>

				</fieldset>

				<fieldset>

					<legend>Identification :</legend>
						<div class="champ">
							<label for="pseudo">Login :</label>
							<input type="text" id="pseudo" name="pseudo" placeholder="Login" minlength="6" maxlength="15" required>
							<label for="password">Password :</label>
							<input type="text" id="password" name="password" placeholder="Password" minlength="6" maxlength="15" required>
						</div>
						<!--<div class="champ">
							<label for="password">Mot de passe :</label>
							<input type="password" name="password" placeholder="Password" minlength="8" required>
						</div>--
						<input type="submit" value="Envoyer">

				</fieldset>

			</form>
		</div>

	</body>

</html>-->