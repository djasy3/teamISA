<?php
    require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
    session_start();
    
    //création des variables
    $userid = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    
    if($userid && $mdp)
    {
	//l'utilisateur essaie de se connecter
	try{
	    login($userid, $mdp);
	    //si le user existe
	    $_SESSION['valid_user'] = $userid;
	}
	catch(Exception $e)
	{
	    echo 'Echec de la connexion';
	    exit();
	}
    }
    //si le user est connecté est qu'il est dans la session, on lui retourne un message d'acceuil
    check_valid_user();
?>