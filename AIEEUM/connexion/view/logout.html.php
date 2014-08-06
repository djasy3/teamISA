<?php
//inclut les fichiers de fonctions pour cette application.
    require_once('../model/aeeium_fns.php');
    session_start();
    $old_user = check_valid_user();
    
    //on stocke l'ancienne varable de session pour voir s'il était connecté.
    unset($_SESSION['valid_user']);
    $result_dest = session_destroy();
    
    //affichage html
    if(!empty($old_user))
    {
	if($result_dest)
	{
	    //s'il était connecté, et qu'il maintenant déconnecté
	    //$_SESSION['valid_user'] = 'Vous êtes déconnecté';
	    //redirection vers la page d'accueil
	    //$_SESSION['valid_user'];
	    echo 'vous êtes déconnecté';
	}else{
	
	    //s'il était connecté et qu'on ne peut pas le déconnecter
	    echo 'Impossible de vous déconnecter';
	}
    }else{
	echo 'Vous n\'étiez pas connecté';
    }
?>