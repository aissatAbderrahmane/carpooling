<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title> Condiction affichage  </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script type="text/javascript" lang="javascript" src="project.js"></script>

</head>
<body>
<br><div id="result"></div>
    <script type="text/javascript">
    	var result = document.getElementById("result");
    </script>
<div id="condiction">
<?PHP

	include("database.php");
	include("mainAll.php");
		$db = new database("localhost","root","","cov");
		$main = new MAIN($db);
	switch(isset($_GET["mode"]) ? $_GET["mode"] : ""){
	case "" : 
?>
<table cellpadding="2" cellspacing="2">
<tr id="head-cond" >
<td class="head-cond-left" >Numero</td>
<td>La Ville</td>
<td>La City</td>
<td>La Ville D'arriver</td>
<td>Nombre de place aui rest</td>
<td>La Date</td>
<td >Le Temp</td>
<td >Les Voyageurs</td>
<td class="head-cond-right">functions</td>
</tr>
<?PHP	
	$select = $db->select("cond");
	while($cond = $db->getinfo($select)){
?>	
<tr id="colum-cond">
<td class="colm-cond-left"><?PHP echo $cond["id_cond"]; ?></td>
<td><?PHP echo $cond["ville"]; ?></td>
<td><?PHP echo $cond["city"]; ?></td>
<td><?PHP echo $cond["ville_arriver"]; ?></td>
<td><?PHP echo $cond["rest"]; ?></td>
<td><?PHP echo $cond["date"]; ?></td>
<td ><?PHP echo $cond["time"]; ?></td>
<td >
<?PHP 
	//LIMIT 0,20
	$select_voyageurs = $db->select("voyageurs"," id_condiction='".$cond["id_cond"]."' ");
	while($fetch_voyageurs = $db->getinfo($select_voyageurs)){
		echo "<a href='#'>".$main->member($fetch_voyageurs["id_voyageur"],"nom")."</a>";
	}

?>
	
</td>
<td class="colm-cond-right">
	<?PHP if($cond["rest"] != 0){ ?>
	<a href="javascript:
	ajaxi({ method : 'GET', action : 'condiction.php', values : { 'mode' : 'addCond', 'id' : '<?PHP echo $cond["id_cond"]; ?>' }},result);
	">
	<img src="IMG/Add.png" /></a>
	<?PHP } ?>
	<a href="javascript:createBox(document.body,'<?PHP echo $cond["ville"]; ?>');"><img src="IMG/false.png" /></a>
	<?PHP  
		$select_cond = $db->select("insp"," id = '".$cond["id"]."'");
		$info_cond = $db->getinfo($select_cond);
	?>
	
	<a href="javascript:createBox(document.body,{
		'Nom':'<?PHP echo $info_cond["nom"]; ?>',
		'Prenom':'<?PHP echo $info_cond["prenom"]; ?>',
		'Email':'<?PHP echo $info_cond["email"]; ?>',
		'Sexe':'<?PHP echo $info_cond["sexe"]; ?>',
		'Caracteres':'<?PHP 
			if($info_cond["fummeur"] == 1)	echo "Fumeur,";else echo "Non Fumeur,";
			if($info_cond["radio"] == 1) echo "Ecoute le radio ou la music ,";else echo "N\'ecoute pas radio ou music,";
			if($info_cond["dusc"] == 1)	echo "Aime Discution.";else echo "N\'aime pas discution.";
		?>'
	});"><img src="IMG/info.png" /></a>
</td>
</tr>	
<?PHP	}
?>
</table>
</div>
<?PHP	
		break;
		case "addCond": 
			if(isset($_GET["id"])) {
				$db->update("cond","rest= rest-1 "," id_cond='".$_GET["id"]."' ");
			}
			echo "Update Done ";
		break;
	}

?>
</body>
</html>