<?php session_start(); require_once('../model/aeeium_fns.php');?>
<html>
    <head>
	<title>réinialiser votre mot de passe</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<h2>Réinitialisation de mot de passe...</h2>
	<form method="POST" action = "../controller/forgot_pass.php" >
	    <table border=0>
		<tr><td>Entrer votre nom d'utilisateur:</td><td><input type="text" name="userid" maxlenght=7 /></td></tr>
		<tr><td><input type="submit" value="changer le mot de passe" /></td></tr>
	    </table>
	    <?php validation_erreur();/*fonction qui permet d'effectuer la validation du coté serveur*/ ?>
	</form>
    </body>
</html>