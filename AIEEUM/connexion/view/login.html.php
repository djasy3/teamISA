<?php session_start(); require_once('../model/aeeium_fns.php');?>
<html>
    <head>
	<title>Connexion au compte</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<?php
	    //on affiche le formulaire que lorsque le user n'est pas connecté
	    $logged_in = check_valid_user();
	    if(empty($logged_in))
	    { ?>
		<h2>connexion à mon compte</h2>
		<form method="POST" action = "../controller/login.php" >
		    <table border=0>
		    <tr>
			<td>pseudo</td><td><input type="text" name="pseudo" maxlength=7 /></td><td>@umoncton.ca</td>
		    </tr>
		    <tr>
			<td>mot de passe</td><td><input type="password" name="mdp" /></td>
		    </tr>
		    <tr>
			<td><input type="submit" value="Connexion" /></td>
		    </tr>
		    </table>
		    <?php validation_erreur();/*fonction qui permet d'effectuer la validation du coté serveur*/ ?>
		</form>
		
		<p>
		    <a href="./forgot_pass.html.php" alt="mot de passe oublié">mot de passe oublié?</a><br />
		    <a href="./activate.html.php" alt="pour la première fois">première fois?</a>
		</p>
	    <?php
		
	    }else
	    {
		echo 'Vous êtes déjà connecté monsieur: '.$logged_in;
	    }
	?>
    </body>
</html>