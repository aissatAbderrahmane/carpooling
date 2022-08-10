<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title> administration  </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script type="text/javascript" lang="javascript" src="project.js"></script>

</head>
<body style="background:#E8E8E8;">
<?PHP
	//<a href="#"><img src="IMG/Add.png" /></a>
	date_default_timezone_set("GMT");
	include("database.php");
	include("mainAll.php");
		$db = new database("localhost","root","","cov");
		$main = new MAIN($db);
		$date = date("Y-m-d");
		$time = date("H:i:s");
?>
<div id="idmHead">
<center>
	<a href="adm.html">Acceuil</a>
	<a href="adm-members.html">Membres</a>
	<a href="adm-trajects.html">Trajects</a>
	<a href="adm-voyageurs.html">Voyageurs</a>
	<a href="home.html">Home</a>
</center>
</div>
<div id="idmcont">
	<?PHP
		switch(isset($_GET["adm"]) ? $_GET["adm"] : ""){
			case "": 
				echo "simple";
			break;
			case "members": 
				 include("admin/members.php");
			break;
			case "trajects": 
				include("admin/trajects.php");
			break;
			case "voyageurs": 
				include("admin/voyageurs.php");
			break;
		}

	?>
</div>
</body>
</html>