<?php
     require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
     
     //créations des variables provenant de login.html.php
    $userid = set_post_var('email');
    //
    session_start();
    
    try{
	//on vérifie que le formulaire a été bien remplie
	if(!filled_out($_POST))
	{
	    $_SESSION['erreur'] = 'Entrer une addresse';
	    header('location: ../view/activate.html.php');
	    exit();
	}
	else{
	    //on vérifie si le mot de passe remplie les conditions
	    if((strlen($userid) != 7))
	    {
		$_SESSION['erreur'] = 'Votre addresse e-mail doit contenir 7 charactères';
		header('location: ../view/activate.html.php');
		exit();
	    }
	}
	//si tout s'est bien passé, l'utilisateur se connecte à son compte
	//on envoi au user un message de remerciement et on lui demande d'activer son compte à travers l'e-mail qu'on lui envoyé
    }
    catch(Exception $e)
    {
	echo $e->getMessage();
	exit();
    }
?>