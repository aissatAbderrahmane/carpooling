<center>
<?PHP
	switch(isset($_GET["mode"]) ? $_GET["mode"] : ""){
		case "":

?>	
<table id="affmem" cellpadding="0" cellspacing="0">
<tr class="titaffmem">
	<td>ID</td>
	<td>Nom</td>
	<td>Prenom</td>
	<td>Email</td>
	<td>functions</td>
</tr>	
<?PHP
//Add, edit, false, female, gender, hide, info, lock, minus, question, true, unlock, trash
	$members = $db->select("insp","","0,20");	
	while($info = $db->getinfo($members)){
?>	
<tr class="valtitmem">
	<td> <?PHP echo $info["id"]; ?></td>
	<td> <?PHP echo $info["nom"]; ?></td>
	<td> <?PHP echo $info["prenom"]; ?></td>
	<td> <?PHP echo $info["email"]; ?></td>
	<td> 
		<a href="editUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/edit.png" /></a>
		<?PHP if($info["level"] != 0){ ?><a href="lockUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/lock.png" /></a>
		<?PHP }else{ ?><a href="unlockUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/unlock.png" /></a>
		<?PHP } ?>
		<a href="deleteUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/trash.png" /></a>
		<a href="infoUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/info.png" /></a>
		<?PHP if($info["level"] != 2){ ?><a href="LvlUpUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/up.png" /></a>
		<?PHP }else{ ?><a href="LvlDownUser-<?PHP echo $info["id"]; ?>.html"><img src="IMG/down.png" /></a>
		<?PHP } ?>
	</td>
</tr>	
<?PHP
	}
?>
</table>

<?PHP
	break;
	case "edit":
		if(isset($_GET["user"])){
			include("editUser.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	case "lock": 
		if(isset($_GET["user"])){
			$select_user = $db->select("insp", "id='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$user = $db->getinfo($select_user);
				if($user["level"] == 1){
					$db->update("insp","level = '0' "," id = '".$_GET["user"]."' ");
					$main->div("le compte a bien été blocker !","t","adm-members.html");
				}elseif($user["level"] == 2){
					$main->div("vous ne pouvez pas blocker un administrateur !","f","adm-members.html");
				}else $main->div("le compte est déjas blocker !","s","adm-members.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	case "unlock": 
		if(isset($_GET["user"])){
			$select_user = $db->select("insp", "id='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$user = $db->getinfo($select_user);
				if($user["level"] == 0){
					$db->update("insp","level = '1' "," id = '".$_GET["user"]."' ");
					$main->div("le compte a bien été déblocker !","t","adm-members.html");
				}else $main->div("le compte est déjas déblocker !","s","adm-members.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	case "delete": 
		if(isset($_GET["user"])){
			$select_user = $db->select("insp", "id='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$user = $db->getinfo($select_user);
				if($user["level"] != 2){
					$db->deletes("insp"," id = '".$_GET["user"]."' ");
					$main->div("le compte a bien été suprrimer !","t","adm-members.html");
				}else $main->div("vous ne pouvez pas suprrimer un administrateur !","f","adm-members.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	case "info": 
		if(isset($_GET["user"])){
			include("infoUser.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	 case "modifier": 
		if(isset($_GET["user"])){
				$_NOM = $db->real_escape_string($_POST["nom"]);
				$_PRENOM = $db->real_escape_string($_POST["prenom"]);
				$_EMAIL = $db->real_escape_string($_POST["email"]);
				$_FUMMEUR = $db->real_escape_string($_POST["fummeur"]);
				$_RADIO = $db->real_escape_string($_POST["radio"]);
				$_DISCUTION = $db->real_escape_string($_POST["discution"]);
				
				$select_user = $db->select("insp", "id='".$_GET["user"]."' ");
				if($select_user->num_rows == 1){
					$user = $db->getinfo($select_user);
					$db->update("insp","nom='".$_NOM."'  "," id = '".$_GET["user"]."' ");
					$db->update("insp","prenom='".$_PRENOM."'  "," id = '".$_GET["user"]."' ");
					$db->update("insp","email='".$_EMAIL."'  "," id = '".$_GET["user"]."' ");
					$db->update("insp","fummeur='".$_FUMMEUR."'  "," id = '".$_GET["user"]."' ");
					$db->update("insp","radio='".$_RADIO."'  "," id = '".$_GET["user"]."' ");
					$db->update("insp","dusc='".$_DISCUTION."'  "," id = '".$_GET["user"]."' ");
					$main->div("Votre Modification a été effectuer !","t","adm-members.html");

				}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");


		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	 	case "lvlDOWN": 
		if(isset($_GET["user"])){
			$select_user = $db->select("insp", "id='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$user = $db->getinfo($select_user);
				if($user["level"] == 2){
					$db->update("insp","level = '1' "," id = '".$_GET["user"]."' ");
					$main->div("le compte a bien été modifier a un utilisateur simple!","t","adm-members.html");
				}elseif($user["level"] == 0 ){
					$main->div("vous ne pouvez pas rendre un compte blocker un utilisateur simple !","f","adm-members.html");
				}else $main->div("le compte est déjas un utilisateur simple !","s","adm-members.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	 	case "lvlUP": 
		if(isset($_GET["user"])){
			$select_user = $db->select("insp", "id='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$user = $db->getinfo($select_user);
				if($user["level"] == 1){
					$db->update("insp","level = '2' "," id = '".$_GET["user"]."' ");
					$main->div("le compte a bien été modifier a un administrateur!","t","adm-members.html");
				}elseif($user["level"] == 0 ){
					$main->div("vous ne pouvez pas rendre un compte blocker un administrateur !","f","adm-members.html");
				}else $main->div("le compte est déjas un administrateur !","s","adm-members.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
		}else $main->div("l'utilisateur n'exist pas !","s","adm-members.html");
	 break;
	}
?>
</center>