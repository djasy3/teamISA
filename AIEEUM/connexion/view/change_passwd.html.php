<?php session_start(); require_once('../model/aeeium_fns.php');?>
<html>
    <head>
	<title>Changement de mot de passe</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<h2>Changement de mot de passe...</h2>
	<?php
	    //on affiche le formulaire que lorsque le user est connecté
	    $logged_in = check_valid_user();
	    if(!empty($logged_in))
	    { ?>
		<h3>vous êtes connecté en tant que <?php echo $logged_in; ?>
		<form method="POST" action = "../controller/change_passwd.php" >
		    <table border=0>
		    <tr>
			<td>Ancien mot de passe:</td><td><input type="password" name="mdp" /></td>
		    </tr>
		    <tr>
			<td>Nouveau mot de passe</td><td><input type="password" name="mdp1" /></td>
		    </tr>
		    <tr>
			<td>Repeter le nouveau mot de passe</td><td><input type="password" name="mdp2" /></td>
		    </tr>
		    <tr>
			<td><input type="submit" value="Changer mot de passe " /></td>
		    </tr>
		    </table>
		    <?php validation_erreur();/*fonction qui permet d'effectuer la validation du coté serveur*/ ?>
		</form>
	    <?php
		
	    }else
	    {
		echo 'Vous n\'êtes pas connecté pour modifier un mot de passe';
	    }
	?>
    </body>
</html>