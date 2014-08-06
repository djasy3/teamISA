<?php session_start(); require_once('../model/aeeium_fns.php');?>
<html>
    <head>
	<title>Activer mon compte</title>
	<meta charset="utf-8" />
    </head>
    <body>
	<h2>Activer mon compte</h2>
	<form method = "POST" action="../controller/activate.php">
	    <table border=0>
		<tr><td>Email:</td><td><input type="text" name="email" maxlength=7 /></td><td>@umoncton.ca</td></tr>
		<tr><td><input type="submit" value="Activer le compte" /></td></tr>
	    </table>
	    <?php validation_erreur();/*fonction qui permet d'effectuer la validation du coté serveur*/ ?>
	</form>
    </body>
</html>