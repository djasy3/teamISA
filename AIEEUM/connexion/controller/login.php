<?php
     require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
      session_start();
     //créations des variables provenant de login.html.php
    $userid = set_post_var('pseudo');
    $passwd = set_post_var('mdp');
    //
    
    try{
	//on vérifie que le formulaire a été bien remplie
	if(!filled_out($_POST))
	{
	    $_SESSION['erreur'] = 'Veuillez remplir correctement le formulaire';
	    header('location: ../view/login.html.php');
	    exit();
	}
	else{
	    //on vérifie si le mot de passe remplie les conditions
	    if((strlen($passwd) < 8) || (strlen($passwd) > 16) )
	    {
		$_SESSION['erreur'] = 'Votre mot de passe doit contenir entre 6 et 16 charactères';
		header('location: ../view/login.html.php');
		exit();
	    }
	}
	//si tout s'est bien passé, l'utilisateur se connecte à son compte
	if(login($userid, $passwd))
	{	//si le user existe
	    $_SESSION['valid_user'] = $userid;
	    $loginView = check_valid_user();
	    echo "Hallo <font color ='blue'>".$loginView."</font>";
	    echo "<br />";
	    echo "<a href='../view/logout.html.php' >logout</a>";
	}
	//else
	//si le user est connecté est qu'il est dans la session, on lui retourne un message d'acceuil
    }
    catch(Exception $e)
    {
	echo $e->getMessage();
	exit();
    }
?>