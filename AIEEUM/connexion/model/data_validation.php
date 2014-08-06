<?php
    
    //fonction qui teste si tous les champs de données ont été bien remplies
    //vérification du coté serveur, bien que la vérification du coté client soit aussi faites
    function filled_out($form_vars)
    {
	//teste si chaque champs du formulaire à une valeur
	foreach($form_vars as $key => $value)
	{
	    if((!isset($key)) || ($value == '')) return false;
	}
	return true;
    }
    //fonction qui vérifie si l'addresse e-mail est correcte
    //à l'aide des expressions régulières
    function valid_email($addresse)
    {
	if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$', $addresse))
	    return true;
	else
	    return false;
    }
    //fonction qui nous permet d'obtenir les valeur exacte des variables globales post
    function get_post_var($var)
    {
	$valeur = $_POST[$var];
	
	if(get_magic_quotes_gpc())
	    $valeur = stripslashes($valeur);
	
	return $valeur;
    }
    //fonction qui nous permet une insertion correcte dans la base de données
    function set_post_var($var)
    {
	$valeur = addslashes(trim($_POST[$var]));
	
	return $valeur;
    }
    //fonction qui renvoit une erreur personnalisé en mode debug
    function fail($pub, $pvt='')
    {
	$msg = $pvt;
	if ($pvt !== '')
		$msg .= ": $pvt";
	exit("Une erreur s'est produite ($msg).\n");
    }
    //fonction qui personnalise les messages d'erreurs si les formulaires ne sont pas bien remplies
    function validation_erreur()
    {
	if(isset($_SESSION['erreur']))
	{
	    $erreur = $_SESSION['erreur'];//on met le message d'erreur dans une variable pour mieux le formater
	    echo "<font color='red'>".$erreur."</font>";
	}
	unset($_SESSION['erreur']);
    }
?>