<?php
    //ps: fichier doit être utiliser pour l'enregistrement du nouvel utilisateur
    require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
    
    //créations des variables provenant de login.php
    $userid = set_post_var('email');
    $nom = set_post_var('nom');
    $prenom = set_post_var('prenom');
    $passwd1 = set_post_var('mdp1');
    $passwd2 = set_post_var('mdp2');
    $email = set_post_var('email');

    session_start();
    
    try{
	//on vérifie que le formulaire a été bien remplie
	if(!filled_out($_POST))
	{
	    $_SESSION['erreur'] = 'Veuillez remplir correctement le formulaire';
	    header('location: ../view/register.html.php');
	    exit();
	}
	//on vérifie si le mot de passe remplie les conditions
	if($passwd1 != $passwd2)
	{
	    $_SESSION['erreur'] = 'Vos mots de passes doivent correspondre';
	    header('location: ../view/register.html.php');
	    exit();
	}
	else
	{
	    if((strlen($passwd1) < 8) || (strlen($passwd1) > 16) )  
	    {
		$_SESSION['erreur'] = 'Votre mot de passe doit contenir entre 6 et 16 charactères';
		header('location: ../view/register.html.php');
		exit();
	    }
	}
	//vérification e-mail
	if(strlen($email) != 7)
	{
	    $_SESSION['erreur'] = 'Votre email doit contenir 7 charactères';
	    header('location: ../view/register.html.php');
	    exit();
	}
	//on complète l'addresse e-mail
	$email = get_user_email($email);
	//on hash le mot de passe
	$mdpHashe = hard_password($passwd1);
	//tentative d'enregistrement
	//la fonction register peut lever une exception
	if(register($userid, $nom, $prenom, $mdpHashe, $email))
	{
	    //ensuite on enregistre la variable dans la session_start
	    $_SESSION['valid_user'] = $userid;
	    //on notifie au user en le rédirigeant vers la page de remerciemment
	    //$_SESSION['valid_user_msg'] = 'Votre compte a été créé';
	    echo $_SESSION['valid_user_msg'] = 'Votre compte à été créé avec success';
	    //unset($_SESSION['valid_user_msg']);//on détruit la session 
	    exit();
	}
	else{
	
	    $_SESSION['erreur'] = 'Votre compte n''a pas été créé, veuillez recommencer';
	    header('location: ../view/register.html.php');
	    exit();
	}
    }
    catch(Exception $e)
    {
	echo $e->getMessage();
	exit();
    }
    
?>