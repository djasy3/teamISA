<?php
    //fonction contenant les différentes fonctions pour hasher le mot de passe
    require_once('PasswordHash.php');
    
    function pass_init()
    {
	$hash_cost_ln = 8;
	//portabilité des tables de hashage pour les systèmes moins sécurisés
	$hash_portable = FALSE;
	//
	$hasher = new PasswordHash($hash_cost_ln, $hash_portable);
	//on retourne l'objet
	return $hasher;
    }
?>