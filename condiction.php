<?PHP
	switch(isset($_GET['step']) ? $_GET['step'] : ''){
		case "voyageur":
			if(isset($_GET["id"])) {
					$verif = $db->select("voyageurs", "id_condiction = '".$_GET["id"]."' and id_voyageur='".$Connected_mem."'  ");
					if($verif->num_rows != 0){
						$main->div("vous ne pouvez pas inscrire 2 fois dans le meme traject","f","home.html");
					}else{
						$verifTRJE = $db->select("cond", "id= '".$Connected_mem."'  ");
						if($verifTRJE->num_rows != 0){
							$main->div(" vous etes un condicteur, vous n'avez pas le droit d'etre un voyageur ! ","s","home.html");
						}else{

						$Montant = $db->select("cond", "id_cond = '".$_GET["id"]."'  ");
						$MontantValeur = $db->getinfo($Montant);
						$db->update("cond","rest= rest-1 "," id_cond='".$_GET["id"]."' ");
						$db->insert("voyageurs","'".$_GET["id"]."','".$Connected_mem."','".$MontantValeur["date"]."','".$MontantValeur["time"]."','".$MontantValeur["montant"]."'");
						$main->div(" vous etes bien ajoutez. ","t","home.html");
						}
					}
			}else $main->div(" ce traject n'exist pas !","s","home.html");
			
		break;
		case "condicteur" :

			if(!empty($_POST["Date"]) && !empty($_POST["Time"]) && !empty($_POST["ville"]) && !empty($_POST["darrive"]) && !empty($_POST["rest"]) && !empty($_POST["mount"]) ){
				if($_POST["Date"] < $date){
					$main->div("Vous ne pouves pas ajouter un traject d'une date passée ! ","f","home.html");	
					}else{
				$verifTrj = $db->select("cond","id='".$Connected_mem."'  ");
				if($verifTrj->num_rows == 0){
				$db->insert("cond","'".$Connected_mem."','".$_POST["Date"]."','".$_POST["Time"]."','".$_POST["ville"]."','".$_POST["darrive"]."','".$_POST["rest"]."','2','".$_POST["mount"]."'");		
				$main->div("Traject a bien été ajouter .","t","home.html");	
					
				}else {
					$main->div("vous avez déjas ajoutez un traject.","s","home.html");
					}
				}
			}else $main->div("les données ne sont pas complets.","f","ajouterTraject.html");	
		
		break;
		case "delvoyageur" :
			if(isset($_GET["id"])) { 
			$verifTrj = $db->select("voyageurs","id_condiction='".$_GET["id"]."' and id_voyageur='".$Connected_mem."' ");
				if($verifTrj->num_rows != 0){
				$db->deletes("voyageurs"," id_condiction='".$_GET["id"]."' and id_voyageur='".$Connected_mem."'  ");
				$db->update("cond","rest = rest+1"," id_cond='".$_GET["id"]."' ");
				$main->div(" vous avez bien annules votre deplacement .","t","home.html");
				}else $main->div(" vous n'etes pas inscrit dans ce traject !","s","home.html");
			}else $main->div(" ce traject n'exist pas !","s","home.html");
		break;
		default: $main->div(" Url unfound !","f","home.html");
	}

?>
