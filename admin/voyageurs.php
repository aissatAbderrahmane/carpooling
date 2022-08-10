<?PHP
	// Add, edit, false, female, gender, hide, info, lock, minus, question, true, unlock, trash
?>	
<center>
<?PHP
	switch(isset($_GET["mode"]) ? $_GET["mode"] : ""){
		case "":

?>	
<table id="affmem" cellpadding="0" cellspacing="0">
<tr class="titaffmem">
	<td>ID</td>
	<td>Nom</td>
	<td> Traject </td>
	<td> Condicteur </td>
	<td> date </td>
	<td> temp </td>
	<td> montant </td>
	<td>functions</td>
</tr>	
<?PHP
//Add, edit, false, female, gender, hide, info, lock, minus, question, true, unlock, trash
	$voyage = $db->select("voyageurs","","0,20");	
	while($info = $db->getinfo($voyage)){
?>	
<tr class="valtitmem">
	<td> <?PHP echo $info["id"]; ?></td>
	<td> <a href="infoUser-<?PHP echo $info["id_voyageur"]; ?>.html"><?PHP echo $main->member($info["id_voyageur"],"nom"); ?></a></td>
	<td> <?PHP 
			$traject = $db->select("cond"," id_cond='".$info["id_condiction"]."' ");
			$traject_info = $db->getinfo($traject);
			echo $traject_info["ville"]." ==> ".$traject_info["ville_arriver"];		
	 ?></td>
	<td> <a href="infoUser-<?PHP echo $traject_info["id"]; ?>.html"><?PHP echo $main->member($traject_info["id"],"nom"); ?></a></td>
	<td> <?PHP echo $info["date"]; ?></td>
	<td> <?PHP echo $info["time"]; ?></td>
	<td> <?PHP echo $info["montant"]; ?></td>
	<td> 
		<a href="DelVoyUser-<?PHP echo $info["id_voyageur"]; ?>-<?PHP echo $info["id_condiction"]; ?>.html"><img src="IMG/trash.png" /></a>
	</td>
</tr>	
<?PHP
	}
?>
</table>

<?PHP
	break;
	case "delete": 
		if(isset($_GET["traject"])){
			$select_trj = $db->select("cond", "id_cond='".$_GET["traject"]."'");
			if($select_trj->num_rows == 1){
			if(isset($_GET["user"])){
			$select_user = $db->select("voyageurs", "id_voyageur='".$_GET["user"]."'");
			if($select_user->num_rows == 1){
				$db->update("cond","rest = rest+1"," id_cond='".$_GET["traject"]."' ");
				$db->deletes("voyageurs","id_voyageur='".$_GET["user"]."'");
				$main->div("l'utilisateur a bien été suprimmer du voyage !","t","adm-voyageurs.html");
			}else $main->div("l'utilisateur n'a pas un voyage !","s","adm-voyageurs.html");
			}else $main->div("l'utilisateur n'exist pas !","s","adm-voyageurs.html");
			}else $main->div("le traject n'exist pas !","s","adm-voyageurs.html");
		}else $main->div("le traject n'exist pas !","s","adm-voyageurs.html");
		// 

	break;
	}
?>
</center>	