<?php session_start(); require_once('../model/aeeium_fns.php');?>
<html>
    <head>
	<title>Créer le compte</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<?php
	    //on affiche le formulaire que lorsque le user n'est pas connecté
	    $logged_in = check_valid_user();
	    if(empty($logged_in))
	    { ?>
		<h2>Créer un compte</h2>
		<form method="POST" action="../controller/register.php">
		    <table border=0>
			<tr>
			    <td>Nom:</td><td><input type="text" name="nom" maxlength=30 /></td><td>Prénom:</td><td><input type="text" name="prenom" maxlength=30 /></td>
			</tr>
			<tr><td>mot de passe:</td><td><input type="password" name="mdp1"  /></td></tr>
			<tr><td>mot de passe(vérification):</td><td><input type="password" name="mdp2"/></td></tr>
			<tr><td>Email:</td><td><input type="text" name="email" maxlength=7 /></td><td>@umoncton.ca</td></tr>
			<tr><td><input type="submit" value="créer compte" /></td></tr>
		    </table>
		    <?php validation_erreur();/*fonction qui permet d'effectuer la validation du coté serveur*/ ?>
		</form>
	    <?php
		
	    }else
	    {
		echo 'Vous êtes déjà connecté monsieur: '.$logged_in;
	    }
	?>
    </body>
</html>