<?PHP
	require_once("database.php");
	$db = new database("localhost","root","","cov");	
	switch($_GET["mode"]){
		case 'inscrire': 
			require_once("inscription.php");
		break;
		case 'ajouteruntraje': 
			
		break;
		case 'demandecond': 
			
		break;
		
		case 'affichage': 
		//$Select = $db->select("insp","fummeur = 0 and sexe='Famme'");
		$Select = $db->select("insp");
		while($Fetch = $Select->fetch_array(MYSQLI_BOTH)){
			echo " le nom est : ".$Fetch["nom"].",le prenom : ".$Fetch["prenom"]." <br>";
		}
		break;
		default : echo "step unknown"; break;
	}
	
	/*
		
		
		
		
		
		
		
		
		$_POST["cbsign"]
	
	$db->query("INSERT INTO insp (id,nom,prenom,email,password,sexe,fummeur,radio,dusc,level) VALUES('','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["user_email"]."','".md5($_POST["password"])."','".$_POST["thelist1"]."','".$_POST["thelist2"]."','".$_POST["thelist3"]."','".$_POST["thelist4"]."','1')");
	echo "inbscription done";

	
	/**$db->query("INSERT INTO cond (id,date,time,ville,city,ville_arriver,rest,level) VALUES('".$_POST["Date"]."','".$_POST["Time"]."','".$_POST["ville"]."','".$_POST["city"]."','".$_POST["rest"]."','".$_POST["darrive"]."','2')");
    echo "inscription done";*/
?>










