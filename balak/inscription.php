<script type="text/javascript">alert("i'm one");</script>
<?PHP
	
	$users = $db->select("insp");
	$verif = true;
	while($val = $db->getinfo($users)){
		if($val["nom"] == $_POST["firstname"] || $val["prenom"] == $_POST["lastname"] || $val["email"] == $_POST["user_email"]){
			$main->div("les informations donnée exist déja dans notre base veuiller changer les information ou recupurer votre donée !","f");
			break;
		}else $verif = false;
	}
	if($verif == false){
			$db->insert("insp","'".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["user_email"]."','".md5($_POST["password"])."','".$_POST["thelist1"]."','".$_POST["thelist2"]."','".$_POST["thelist3"]."','".$_POST["thelist4"]."','1'");
			$main->div("inscription done","t");
	}
		
			?>