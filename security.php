<?PHP

	class security {
			private $database;
		function __construct($db){
			$this->database = $db;
		}
		function protected_post($valeur,$type){
			if($type == "int"){
				$valeur = intval($valeur);
			}else if($type == "text"){
				$valeur = htmlspecialchars($valeur);
				$valeur = $this->database->real_escape_string($valeur);
			}else die(" type of security indefined !");
			return $valeur;
		}
	
	}

?>