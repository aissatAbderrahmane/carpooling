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
	<td> Condicteur</td>
	<td> ville </td>
	<td> ville_arriver </td>
	<td> date </td>
	<td> temp </td>
	<td> reste </td>
	<td> voyageurs </td>
	<td> montant </td>
	<td>functions</td>
</tr>	
<?PHP
//Add, edit, false, female, gender, hide, info, lock, minus, question, true, unlock, trash
	$trajects = $db->select("cond","","0,20");	
	while($info = $db->getinfo($trajects)){
?>	
<tr class="valtitmem">
	<td> <?PHP echo $info["id_cond"]; ?></td>
	<td> <a href="infoUser-<?PHP echo $info["id"]; ?>.html"><?PHP echo $main->member($info["id"],"nom"); ?></a></td>
	<td> <?PHP echo $info["ville"]; ?></td>
	<td> <?PHP echo $info["ville_arriver"]; ?></td>
	<td> <?PHP echo $info["date"]; ?></td>
	<td> <?PHP echo $info["time"]; ?></td>
	<td> <?PHP echo $info["rest"]; ?></td>
	<td> <?PHP 
			$sl_voy = $db->select("voyageurs","id_condiction='".$info["id_cond"]."'");
			if($sl_voy->num_rows >=1){
				while($valVoy = $db->getinfo($sl_voy)){
				?>
					<a href="infoUser-<?PHP echo $valVoy["id_voyageur"]; ?>.html">
						<?PHP echo $main->member($valVoy["id_voyageur"],"nom"); ?>
					</a> 
				<?PHP 	
				}
			}else echo "pas des voyageurs";
		?></td>
	<td> <?PHP echo $info["montant"]; ?></td>
	<td> 
		<a href="DelTraject-<?PHP echo $info["id_cond"] ?>.html"><img src="IMG/trash.png" /></a>
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
				$select_voy = $db->select("voyageurs", "id_condiction='".$_GET["traject"]."'");
				if($select_voy->num_rows >= 1){
				while($voyag = $db->getinfo($select_voy)){
					$db->deletes("voyageurs"," id_condiction='".$_GET["traject"]."' ");
				}
				}
				$db->deletes("cond","id_cond='".$_GET["traject"]."'");
				$main->div(" la supression du trajet a bien été effectuer !","t","adm-trajects.html");
			}else $main->div("le traject n'exist pas !","s","adm-trajects.html");
			}else $main->div("le traject n'exist pas !","s","adm-trajects.html");
		
		// 

	break;
	}
?>
</center>	