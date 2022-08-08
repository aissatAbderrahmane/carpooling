<?PHP

	include("TmpHTML/header.html");
	if($_GET["mode"] == null) include("TmpHTML/bodyStart.html");
	include("TmpHTML/body.html");
	if($_GET["mode"] == "find"){
	include("TmpHTML/content.html");
	}else include("TmpHTML/PageNotFound.html");
	include("TmpHTML/footer.html");


?>
