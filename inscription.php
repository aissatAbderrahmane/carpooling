<?PHP
	
	
	$users = $db->select("insp");
	$verif = true;
	$val = $db->getinfo($users);
	if(isset($val["id"])){
	while($val){	
		if($val["nom"] == $_POST["firstname"] || $val["prenom"] == $_POST["lastname"] || $val["email"] == $_POST["user_email"]){
			$main->div("les informations donnée exist déja dans notre base veuiller changer les information ou recupurer votre donée !","f","regoindre.html");
			$verif = true;
			break;
		}else $verif = false; 
		break;
	}
	}else { $verif = false;  }
	if($verif == false){
		if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["user_email"]) && !empty($_POST["password"]) && !empty($_POST["thelist3"]) && !empty($_POST["thelist1"]) && !empty($_POST["thelist2"]) && !empty($_POST["thelist4"])){
			
			$db->insert("insp","'".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["user_email"]."','".md5($_POST["password"])."','".$_POST["thelist1"]."','".$_POST["thelist2"]."','".$_POST["thelist3"]."','".$_POST["thelist4"]."','1'");

			$main->div("inscription done","t","home.html");
		}else $main->div("il faut remplire tout les champs","f","regoindre.html");
	}
		
			?>