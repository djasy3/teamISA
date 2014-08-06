<?php
    require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
    session_start();
    //création des variables
    $user_id = set_post_var('userid');
    
    try{
	if(!filled_out($_POST))
	{
	    $_SESSION['erreur'] = 'Veuillez remplir correctement le formulaire';
	    header('location: ../view/forgot_pass.html.php');
	    exit();
	}
	//appel à la fonction reset_password
	$password = reset_password($user_id);
	//ensuite on envoie la notification à l'utilisateur
	notify_password($user_id, $password);
	$_SESSION['erreur'] = 'votre mot de passe à été envoyé à votre e-mail';// à changer
	//sleep(5);
	header('location: ../view/login.html.php');
	exit();
    }
    catch(Exception $e)
    {
	$_SESSION['erreur'] = 'votre mot de passe n\'a pas pu être réinitialisé !';
	header('location: ../view/forgot_pass.html.php');
	exit();
    }
?>