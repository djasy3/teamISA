<?php

	function bdd_connect()
	{
		for($i = 0; $i < 5; $i++) //Retry a maximum of 5 times
		{
			try
			{
				//Connecting and setting the error mode
				$bdd = new PDO("mysql:host=localhost;dbname=db_info4007;charset=utf8", "root", ""); //<== config here
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $bdd; //If no exception thrown until here it means the connection ($db) is valid
			}
			catch(PDOException $e)
			{	echo 'Échec lors de la connexion : ' . $e->getMessage();
				//Connection fail, waiting 5 seconds and retrying
				sleep(5);
			}
		}

		return false; //If we reach that line, that means the mysql server is unreachable
	}

				
function nbVisite($ip) {
  $bdd = bdd_connect();
  $query1 = $bdd->prepare("SELECT prenom, nom FROM utilisateur WHERE id = :pseudo");
    $query1->execute(array('pseudo' => $_SESSION['id']));
    $reponse = $query1->fetch();
    $prenom = $reponse['prenom'];
    $nom = $reponse['nom'];
  $query = $bdd->prepare("SELECT compte FROM compteur WHERE ip_address =  :ip");
    $query->execute(array('ip' => $ip));
    $reponse = $query->fetch();
    $hits = $reponse['compte'];
    echo "". $prenom ." ". $nom." : Vous avez consulté ce site " . $hits . " fois";
    }

function compteur($ip,$agent,$datetime) {
	  $bdd = bdd_connect();
 // regarde si l'ip est deja dans la base de donnee
 	 $query = $bdd->prepare("SELECT ip_address FROM compteur WHERE ip_address = :ip");
     $query->execute(array('ip' => $ip));
	 $count = $query->rowCount();
	 if ($count == 0) 
	{
		//si non, insert les donneers et commence le compteur a 1.
		$insert = $bdd->prepare('
                  INSERT INTO compteur (ip_address, user_agent, datetime, compte)
                  VALUES(:ip_address, :user_agent, :datetime, :compte)
                  ');
                  $insert->execute(array('ip_address' => $ip,'user_agent' => $agent,'datetime' => $datetime,'compte' => 1));
		
		//update le compteur global
		$update = $bdd->prepare('UPDATE compteurglobal SET compte = compte+1');
		$update->execute(); 
			
	}
	else
	{	
		//si oui, update le compte s'il visite le site 12 heures ou plus apres sa derniere visite
		$query = $bdd->prepare("SELECT datetime FROM compteur WHERE ip_address =  :ip");
    	$query->execute(array('ip' => $ip));
    	$reponse = $query->fetch();
		$datePrec = $reponse['datetime'];
		
		//converti en seconde et compare
		if ( strtotime("$datePrec") < strtotime("$datetime") - (12 * 60 * 60) )
		{	
			//update le compteur individuel
			$update = $bdd->prepare('UPDATE compteur SET compte = compte+1 WHERE ip_address = :ip');
			$update->execute(array('ip' => $ip)); 
						
			//update le compteur global
			$update1 = $bdd->prepare('UPDATE compteurglobal SET compte = compte+1');
			$update1->execute();  

			//update la derniere visite
			$update2 = $bdd->prepare('UPDATE compteur SET datetime = :datetime WHERE ip_address = :ip');
			$update2->execute(array('ip' => $ip,'datetime'=>$datetime));
		}

	}
 }
 
  
function crypt_mdp ($mdp_a_crypte) {
$mdp = $mdp_a_crypte;
for ($i=0;$i<65535;$i++) { 
$mdp = sha1($mdp);
$mdp = md5($mdp);
}
return $mdp;
}

function verif_mail() {
$bdd = bdd_connect();
$mail = htmlspecialchars($_POST['mail']);
$query = $bdd->prepare('
  SELECT * FROM membre WHERE mail = :mail
  ');
  $query->execute(array(
  'mail' => $mail,
  ));
$count = $query->rowCount();
    if ($count == 0)
     {
        $verif_mail = true;
        }
      else
      {
          $verif_mail = false;
          }
     return $verif_mail;
  }	


function delete_msg() {
  $bdd = bdd_connect();
  $time_out = time()-900;
  $recup_message = $bdd->prepare('SELECT * FROM chat_messages WHERE timestamp < :time');
  $recup_message->execute(array(
  'time' => $time_out
  ));
  while ($message = $recup_message->fetch()) {
      $query_1 = $bdd->prepare('INSERT INTO ancien_message (message, pseudo) VALUES (:message, :pseudo)');
      $query_1->execute(array(
      'message' => $message['message_text'],
      'pseudo' => $message['pseudo'],
      ));
      }
  $query = $bdd->prepare("DELETE FROM chat_messages WHERE timestamp < :time");
  $query->execute(array(
      'time' => $time_out
      ));
   
      }	