<?php

    require_once('aeeium_fns.php');
    //fonction de connexion
    
    function login($userid, $password)
    {
	//on vérifie le nom d'utilisateur et le mot de passe dans la base de données
	//on renvoie true si ok ,si non on lèrve une exception.
	//connexion à la base de données
	try{
	    $idcnx = cnx_bdd('aeeium', 'bddparm');
	    //requete au serveur !
	    $result = $idcnx->query("SELECT et_passwdhash FROM t_etudiants where et_id= '".$userid."'");
	    //méthode inspirée de openwall(passwordhash)
	    $hasher = pass_init();//on fait appel aux paramètres
	    $hash = '*';//au cas ou l'utilisateur ne serait pas trouvé	    
	    $result->bindColumn(1, $hash);//on lie la colonne password à la variables hash pour nous permettre de comparer le mot de passe du user qui tente de se connecter;
	    if(!$result->fetch(PDO::FETCH_BOUND))
	    {
		$_SESSION['erreur'] = 'Utilisateur non existant';
		header('location: ../view/login.html.php');
	    }
	    
	    if($hasher->CheckPassword($password, $hash))
	    {
		unset($hasher);
		return true;
	    }
	    else
	    {
		unset($hasher);
		echo 'Mot de passe Utilisateurs incorrecte!';
		exit();
	    }
	    //unset($hasher);
	}
	catch(PDOException $e)
	{
	    echo $e->getMessage();
	}
	$idcnx = NULL;
    }
    //fonction qui nous permet d'enregistrer un nouvle utilisateur dans la base de données
    function register($userid, $nom, $prenom, $passwd, $email)
    {
	//on se connecte à la base de données
	$idcnx = cnx_bdd('aeeium', 'bddparm');
	//on vérifie si le nom du user est unique
	$result =  $idcnx->query("SELECT * FROM t_etudiants where et_id ='".$userid."'");
	
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    throw new Exception("Impossible d'executer la requête ".$erreur[2]." code: ".$idcnx->errorCode());// à revoir pour personnalisation
	}
	
	//si la base renvoie une ligne > 0, donc il existe un user de ce nom
	if($result->rowCount()>0)
	{
	    //$erreur = $idcnx->errorInfo();
	    //echo $idcnx->errorCode()." Code: ".$erreur[2];
	    throw new Exception("Cette addresse e-mail existe déjà");//à revoir pour personnalisation
	}
	//si tout est bon, on ajoute l'utilisateur à la base de données
	$result = $idcnx->exec("INSERT INTO t_etudiants VALUES
				('".$userid."','".$prenom."','".$nom."','".$email."','".$passwd."',NOW(), NOW() )");
	//erreur lors de l'ajout
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    throw new Exception("Erreur d'activation, veuillez réessayer plutard ".$erreur[2]." code: ".$idcnx->errorCode());//à revoir pour ...
	}
	$idcnx = NULL;
	
	return true;
    }
    //fonction qui va nous permettre d'obtenir l'id du user à partir de son e-mail
    function get_user_email($email)
    {
	return $email."@umoncton.ca";
    }
     //fonction qui va nous permettre de hasher le mot de passe
    function hard_password($var)
    {
	$hasher = pass_init();//on fait appel aux paramètres
	$hash   = $hasher->HashPassword($var);
	//le hashage ne doit pas être en dessous de 20
	if(strlen($hash) < 20)
	{
	    fail('Impossible de hasher le mot de passe');
	}
	unset($hasher);
	
	return $hash;
    }
    //fonction qui modifie le mot de passe
    //elle renvoie true ou lève une exception
    function change_password($userid,$old_passwd,$new_passwd)
    {
	//on fait appel à la fonction login pour vérifier si l'ancien password est correcte
	//si non on lève un exception
	try{
	    if(login($userid, $old_passwd))
	    {
		//on se connecte à la base de données
		$idcnx = cnx_bdd('aeeium', 'bddparm');
		//on hash le mot de passe
		$mdpHashe = hard_password($new_passwd);
		$result = $idcnx->exec("UPDATE t_etudiants 
					SET et_passwdhash ='".$mdpHashe."'
					WHERE et_id = '".$userid."'");
					
		$idcnx = NULL;
	    }
	    else
	    {
		$_SESSION['erreur'] = 'Votre ancien mot de passe est incorrecte';
		header('location: ../view/change_passwd.html.php');
		exit();
	    }
	    //au cas où tout est correcte
	    if(!$result)
	    {
		$_SESSION['erreur'] = 'Votre mot n\'a pas pu être changé, une erreur est sourvenue';
		header('location: ../view/change_passwd.html.php');
		exit();
	    }
	    else
		return true;
	    
	}catch(Exception $e)
	{
	    echo $e->getMessage();
	    exit();
	}
    }
    
    //fonction qui vérifie si quelqu'un est connecté
    function check_valid_user()
    {
	if(isset($_SESSION['valid_user']))
	{
	    $loginView = $_SESSION['valid_user'];
	    return $loginView;//on retourne la variable pour permettre le formattage
	}
	else
	{
	    $loginView = '';
	    return $loginView;
	    exit();
	}
    }
    //fonction qui renvoi un mot tiré aléatoirement dans le dictionnaire système
    function get_random_word($min_length, $max_length)
    {
	//on produit un mot aléatoire !
	$word ='';
	//modifier le chemin pour l'adapter au sytème host
	$dictionary = '/usr/share/dict/words';//le ispell dictionary
	$fp = @fopen($dictionary, 'r');
	if(!$fp) return false;
	
	$size = filesize($dictionary);
	//on se place dans un endroit aléatoire dans le dicionnaire
	$rand_location = rand(0, $size);
	fseek($fp, $rand_location);
	
	//on récupère le prochain mot dont la longueur est correcte.
	while ((strlen($word) < $min_length) || (strlen($word) > $max_length) || (strstr($word, "'")))
	{
	    if(feof($fp)) fseek($fp, 0); //si on est à la fin, on revient au début
	    //on saute le premier mot car il peut être incomplet
	    $word = fgets($fp, 80);
	    //le mot de passe potentiel
	    $word = fgets($fp, 80);
	}
	$word = trim($word);// on ôte le \n ajouté par fgets
	return $word;
    }
    //fonction de réinitialisation du mot de passe
    function reset_password($userid)
    {
	//on choisit un mot de passe aléatoire et on la fonction le renvoi 
	//on effectue une recherche d'un mot quelconque dans le dictionnaire du système(système unix);
	$new_passwd = get_random_word(6, 13);
	if($new_passwd == false) throw new Exception('Le mot de passe n\'a pas pu être généré');
	//on ajoute un nombre entre 0 et 999 pour améliorer le mot de passe !
	$rand_nbre = rand(0, 999);
	$new_passwd .= $rand_nbre;
	
	//ensuite on modifie le mot de passe dans  la bdd
	$idcnx = cnx_bdd('aeeium', 'bddparm');
	
	$mdpHashe = hard_password($new_passwd);
	
	$result = $idcnx->exec("UPDATE t_etudiants 
				SET et_passwdhash ='".$mdpHashe."'
				WHERE et_id = '".$userid."'");
	
	if(!$result) throw new Exception('Le mot de passe n\'a pas pu être changé');
	else return $new_passwd;//on retourne le nouveau mot de passe
	
	$idcnx = NULL;
    }
    //fonction qui envoi le mot de passe au user à travers un e-mail
    function notify_password($userid, $passwd)
    {
	ini_set("SMTP","smtp.yahoo.com" );
	ini_set('sendmail_from', 'mukeyajunior@yahoo.fr'); 
	//avertit le user que son mot de passe a changé
	//on se connecte à la bdd pour récupérer l'addresse e-mail
	$idcnx = cnx_bdd('aeeium', 'bddparm');
	$result =  $idcnx->query("SELECT et_email FROM t_etudiants where et_id ='".$userid."'");
	//
	if(!$result) throw new Exception('Adresse e-mail introuvable');
	//$erreur = $idcnx->errorInfo();
	else if($result->rowCount() == 0) throw new Exception('Utilisateur inexistant');
	else//on compose le message
	{
	    $row = $result->fetch(PDO::FETCH_OBJ);
	    if(!$row) throw new Exception('Impossible de recupérer l addresse');
	    $email = $row->et_email;
	    $from = "From: mukeyajunior@yahoo.fr \r\n";
	    $msg = "Votre mot de passe à été changé à : "
		    .$passwd."\r\n"
		    ."Svp, veuillez le changer la prochaine fois que vous vous connectez.\r\n";
	    
	    if(mail($email, 'Aeeium Information compte', $msg, $from)) return true;
	    else throw new Exception('Le message n\'a pas pus être envoyé');
	}
	
    }
?>