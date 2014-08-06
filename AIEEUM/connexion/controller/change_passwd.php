<?php
    //ps: fichier doit être utiliser pour l'enregistrement du nouvel utilisateur
    require_once('../model/aeeium_fns.php');//fichier contenant toutes les fonctions
    session_start();
    
    //création des variables
    $old_passwd = set_post_var('mdp');
    $new_passwd1 = set_post_var('mdp1');
    $new_passwd2 = set_post_var('mdp2');
    //
    try{
	if(!filled_out($_POST))
	{
	    $_SESSION['erreur'] = 'Veuillez remplir correctement le formulaire';
	    header('location: ../view/change_passwd.html.php');
	    exit();
	}
	//on vérifie si le mot de passe remplie les conditions
	if($new_passwd1 != $new_passwd2)
	{
	    $_SESSION['erreur'] = 'Vos mots de passes doivent correspondre';
	    header('location: ../view/change_passwd.html.php');
	    exit();
	}
	else
	{
	    if((strlen($new_passwd1) < 8) || (strlen($new_passwd1) > 16) )
	    {
		$_SESSION['erreur'] = 'Votre mot de passe doit contenir entre 6 et 16 charactères';
		header('location: ../view/change_passwd.html.php');
		exit();
	    }
	}
	//tentative de mise à jour
	//on fait appel à la fonction change password
	if(change_password(check_valid_user(),$old_passwd,$new_passwd1))
	{
	    echo 'Votre mot de passe à été changé';
	}
    }catch(Exception $e){
	echo $e->getMessage();
	exit();
    }
?>