
<?PHP
session_start();
/*
^ajouterTraject\.html$ /prj/www/index.php?mode=cov [L]
^ajouterVoyageur\.html$ /prj/www/index.php?mode=voy [L]
^regoindre\.html$ /prj/www/index.php?mode=inscription [L]
^inscrieVoyageur\.html$ /prj/www/index.php?mode=inscrire?step=voyageur[L]
^inscrieTraject\.html$ /prj/www/index.php?mode=inscrire?step=condicteur [L]
^inscription\.html$ /prj/www/index.php?mode=inscrire?step=membre[L]

*/
	date_default_timezone_set("GMT");
	include("database.php");
	include("security.php");
	include("mainAll.php");
	$db = new database("localhost","root","","cov");
	$sec = new security($db);
	$main = new MAIN($db);
	$date = date("Y-m-d");
	$time = date("H:i:s");
	include("UpdateDB.php");
	if(isset($_SESSION["email"])) $Connected_mem = $main->connected_member($_SESSION["email"],"id");
		include("TmpHTML/header.html");
   		include("TmpHTML/body.html"); 
	switch(isset($_GET['mode']) ? $_GET['mode'] : '' ) {
		case '': include("TmpHTML/bodyStart.html"); break;
		case 'find' :
			include("TmpHTML/content.html");
		break;
		case 'connexion':
			include("cnx.php");
		break;
		case 'deconnexion': 
			$main->div("deconnexion donne .","t","home.html");
			session_destroy();
		break;
		case 'cov':
				 include("TmpHTML/cov.html"); 
		break;
		case 'inscrire': // add to database
			switch(isset($_GET['step']) ? $_GET['step'] : ''){
				case 'condicteur' : 
					include("condiction.php");
				break;
				case 'voyageur' : 
					if(isset($_GET["id"])){
						include("condiction.php");
					}
				break;
				case 'delvoyageur' : 
					if(isset($_GET["id"])){
						include("condiction.php");
					}
				break;	
				case 'membre' : 
					include("inscription.php");
				break;

			}
		 break;
		 case 'inscription': 
		 	include("TmpHTML/insc.html");
		 break;
		 case 'trouverTRJ' : 
		 	include("TmpHTML/trajectF.html");
		 break;
		 case 'membre': 
		 	if(isset($_GET["id"]) && $_GET["id"] != 0){
		 	include("TmpHTML/membre.html");
		 }else $main->div("membre n'exist pas, ou vous avez suivis un faux lien !","f","home.html");
		 break;
		 case 'map': 
		 	if(isset($_GET["id"]) && $_GET["id"] != 0){
		 	include("TmpHTML/maps.html");
		 }else $main->div("ce traject n'exist pas !","f","home.html");
		 break;	
		default: 
			include("TmpHTML/PageNotFound.html"); 
		break;

	
	}
	include("TmpHTML/footer.html"); 

?>
