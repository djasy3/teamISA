<?php
session_start();
require ('script/functions.php');
//Prend les informations des utilisateurs
	$ip = $_SERVER["REMOTE_ADDR"]; 
	$agent = $_SERVER["HTTP_USER_AGENT"]; //browser & systeme d'exploitation
	$datetime = date("Y/m/d") . ' ' . date('H:i:s') ;
	
	compteur($ip,$agent,$datetime);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Departement D'informatique </title>
<meta name="keywords" content="graphite theme, professional, free templates, CSS, HTML" />
<meta name="description" content="Graphite Theme, professional free CSS template from templatemo.com website" />
<link href="css/2.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/1.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script>
		$(document).ready(function() {
																
			$('#rmmap').click(function(){
				$('#mmap').show();
				$('#emap').hide();
				$('#smap').hide();
				});
		
			$('#remap').click(function(){
				$('#emap').show();
				$('#mmap').hide();
				$('#smap').hide();
				});
			
			$('#rsmap').click(function(){
				$('#smap').show();
				$('#mmap').hide();
				$('#emap').hide();
				});
	});
    </script> 
<script>

function mon(){
$('#mmap').show();
$('#emap').hide();
$('#smap').hide();
}
</script>

</head>
<body id="home" onLoad="mon()">
<div id="templatemo_wrapper">
	<div id="templatemo_top">
    	<?php if (isset($_SESSION['id']))echo '<div class="dec"><a href="script/deconnexion.php">Deconnexion</a></div>' ?>
       <?php if (!isset($_SESSION['id'])) echo'        
    	<div id="templatemo_login">
            <form action="index.php" method="post">
              <input type="text" placeholder="identifiant" name="id" size="10" title="identifiant" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" required />
              <input type="password" value="password" name="password" size="10" title="password" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" required />
              <input type="submit" name="connexion" value="connexion" alt="Search" title="connexion" class="sub_btn"  />
            </form>
            
		</div>
              ' ?>                 
    </div> <!-- end of top -->
    
  <div id="templatemo_header">
    	<div id="site_title"><h1><a href="login.php"></a></h1></div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
              	
       		  <li><a href="index.php">Acceuil</a></li>
              	<li><a href="#"><img src="images/menu/questions_icon_blue.png" width="40" height="40" />Sondage</a></li>
              	<li><a href="indenteur/index.php"><img src="images/menu/indenteur.png" width="40" height="40" />Indenteur</a></li>
				<li><a href="emulateur"><img src="images/menu/c++.png" width="40" height="40" />Exemples C++</a></li>
                <li><a href="#">Plus</a>
                	<ul>
              <?php if (isset($_SESSION['id']))echo '<li><a href="#"><img src="images/menu/depot.png" width="30" height="30" />Dépôt</a></li>' ?>
                		<li><a href="galerie.php"><img src="images/menu/gallery.png" width="30" height="30" />Galerie Photos</a></li>
                        <?php if (isset($_SESSION['id']))echo '<li><a href="commentaire/index.php"><img src="images/menu/comments.png" width="30" height="30" />Commentaire</a></li>' ?>
                	</ul>
              </li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- end of header -->
    
    <div id="templatemo_middle">
      <div id="mid_slider">
	           
      </div>
        <div id="mid_left">
            <div id="mid_title">
			   
  				<p><?php if (isset($_SESSION['id'])) echo nbVisite($ip); ?></p>
          </div>    
        </div>
        	
						<div  class = "btn-groupe" align = "center"> 
						  <button  type = "button"  class = "btn btn-défaut" id = "rmmap"><a href="#" >Moncton</a></button> 
						  <button  type = "button"  class = "btn btn-défaut" id = "rsmap"><a href="#" >Shippagan</a></button> 
						  <button  type = "button"  class = "btn btn-défaut" id = "remap"><a href="#" >Edmunston</a></button> 
						</div>
				
			
	  <div id = "mmap">
				<div class="countener"style="max-width:600px;margin:auto;">
					
					<div  class="thumbnail">
						<ul class="nav nav-pills nav-stacked">
						  <li class="active">
							<a href="https://www.google.ca/maps/preview?q=universit%C3%A9+de+moncton&ie=UTF-8&ei=K_U2U6KoLbKxsATKtIHYBg&ved=0CAgQ_AUoAQ&source=newuser-ws">
							  <span class="badge pull-right"><var>18 avenue Antonine-Maillet<var></span>
							  Adresse
							</a>
						  </li>
						  <li class="active">
							<a href="#">
							  <span class="badge pull-right"><var>NB E1A 3E9 Canada</var></span>
							  Code postal
							</a>
						  </li>
						  <li class="active">
							<a href="http://fr.411.ca/business/profile/6054081">
							  <span class="badge pull-right"><var>(506) 858-3737</var></span>
							  Téléphone
							</a>
						  </li>
						  <li class="active">
							<a href="#">
							  <span class="badge pull-right"><var>(506) 858-4630</var></span>
							  Télécopieur
							</a>
						  </li>
						</ul>
						
						<iframe  style="min-width:100%;" HEIGHT="700" frameborder="0"
						scrolling="no" marginheight="0" marginwidth="0"
						src="http://www.openstreetmap.org/export/embed.html?
						bbox=-64.80148315429688%2C46.09698358555278%2C-64.77230072021484%2C46.11305121525992&amp;
						layer=mapnik&amp;marker=46.10501798579857%2C-64.78689193725586"
						style="border: 1px solid black" id="main">
						</iframe>
			
					</div>
				</div>
			</div><!-- fin mmap -->
			
			<div id = "emap" >
								<div  class="countener"style="max-width:600px;margin:auto;">
								
								<div  class="thumbnail">
									<ul class="nav nav-pills nav-stacked">
									  <li class="active">
										<a href="https://www.google.ca/maps/place/Universit%C3%A9+de+Moncton,+campus+d'Edmundston/@47.371404,-68.315002,17z/data=!3m1!4b1!4m2!3m1!1s0x4cbda99285b3e59f:0x56c76d25f5510354">
										  <span class="badge pull-right"><var>165 boulevard Hébert<var></span>
										  Adresse
										</a>
									  </li>
									  <li class="active">
										<a href="#">
										  <span class="badge pull-right"><var>NB E3V 2S8 Canada</var></span>
										  Code postal
										</a>
									  </li>
									  <li class="active">
										<a href="http://fr.411.ca/business/profile/6067659">
										  <span class="badge pull-right"><var>(506) 737-5049</var></span>
										  Téléphone
										</a>
									  </li>
									  <li class="active">
										<a href="#">
										  <span class="badge pull-right"><var>(506) 737-5373</var></span>
										  Télécopieur
										</a>
									  </li>
									</ul>
							<iframe style="min-width:100%;" height="700" frameborder="0"
							scrolling="no" marginheight="0" marginwidth="0"
							src="http://www.openstreetmap.org/export/embed.
							html?bbox=-68.31825613975525%2C47.36975332632193%2C
							-68.314608335495%2C47.37187139840633&amp;layer=
							mapnik&amp;marker=47.370812372997015%2C-68.31643223762512"
							style="border: 1px solid black"></iframe>
							
							</div>
							</div>
			</div><!-- fin emap -->
			
			<div id = "smap" >
							<div class="countener" style="max-width:600px;margin:auto;">
								<div class="countener"style="max-width:600px;margin:auto;">
								
								<div  class="thumbnail">
									<ul class="nav nav-pills nav-stacked">
									  <li class="active">
										<a href="https://www.google.ca/maps/place/Universit%C3%A9+De+Moncton/@47.744385,-64.719425,17z/data=!3m1!4b1!4m2!3m1!1s0x4c9f293400000000:0x5e317b14bd85451f">
										  <span class="badge pull-right"><var>218 boulevard J.-D.-Gauthier<var></span>
										  Adresse
										</a>
									  </li>
									  <li class="active">
										<a href="#">
										  <span class="badge pull-right"><var>NB E8S 1P6 Canada</var></span>
										  Code postal
										</a>
									  </li>
									  <li class="active">
										<a href="http://fr.411.ca/business/profile/13561693">
										  <span class="badge pull-right"><var>(506) 336-3400</var></span>
										  Téléphone
										</a>
									  </li>
									  <li class="active">
										<a href="#">
										  <span class="badge pull-right"><var>(506) 336-3604</var></span>
										  Télécopieur
										</a>
									  </li>
									</ul>
							<iframe style="min-width:100%;" HEIGHT="700" frameborder="0"
							scrolling="no" marginheight="0" marginwidth="0"
							src="http://www.openstreetmap.org/export/embed.html
							?bbox=-64.71165060997009%2C47.74479219040294%2C-64.
							70982670783997%2C47.74584368369329&amp;layer=mapnik&amp;
							marker=47.74531793970321%2C-64.71073865890503" 
							style="border: 1px solid black"></iframe>
							</div>
							</div>
				</div>
			</div><!-- fin smap -->
	  </div>
		<div class="status"></div>
        <div class="cleaner"></div>
    </div> <!-- end of templatemo_middle -->
    
    <div id="templatemo_main">
    	
        
       
        <div class="cleaner"></div>
    </div> <!-- end of main -->
</div> <!-- end of wrapper -->
<div id="templatemo_footer_wrapper">
    <div id="templatemo_footer">
       Copyright © 2014 <a href="#">Departement d'Informatique</a>
        <div class="cleaner"></div>
    </div>
</div> 

</body>
</html>
