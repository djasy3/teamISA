<?php
    //fichier de connexion à la base de données
    //fonctions de connexion, requetes, etc...
    
    //fonction de connexion
    function cnx_bdd($base, $param)
    {
	//inclusion des paramètres de connexion
	require_once($param.".inc.php");
	//connexion au serveur
	$dsn = "mysql:host=".MYHOST.";dbname=".$base;//data source name
	$user= MYUSER;
	$pass= MYPASS;
	
	try{
	    $idcnx= new PDO($dsn, $user, $pass);
	    $idcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $idcnx;
	}
	catch(PDOException $ex){
	    
	    echo "Echec de la connexion ".$ex->getMessage();
	    return false;
	    exit();
	}
    }
    //fonction 
?>