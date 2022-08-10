
<?PHP

session_start();
	include("database.php");
	include("security.php");
	include("mainAll.php");
	$db = new database("localhost","root","","cov");
	$sec = new security($db);
	$main = new MAIN($db);
	$email =$sec->protected_post($_POST["email"],"text");
		$pass = $sec->protected_post($_POST["password"],"text");
			$select = $db->select("insp","email='".$email."' and password='".md5($pass)."' ");
			if($select->num_rows == 1){
				$member = $db->getinfo($select);
				if($member["level"] != 0){
				$_SESSION["id"] = md5($member["id"]+1);
				$_SESSION["email"] = $member["email"];
				$_SESSION["fume"] = $member["fummeur"];
				$_SESSION["desc"] = $member["dusc"];
				$_SESSION["rad"] = $member["radio"];
				$_SESSION["lvl"] = $member["level"];
				$_SESSION["date"] = date("Y-m-d");
				$main->div("connexion donne","t","home.html");
				}else $main->div("désoler , votre compte a été blocker par l'administration !","f");

			}else $main->div("désoler , vous n'etes pas inscrit !","s");
		






?>