<?PHP
	class database extends mysqli{
		function __construct($server,$user,$password,$dbName){
			return parent::__construct($server,$user,$password,$dbName);
		}
		public function insert($table,$values){
				$SQL = "INSERT INTO ".$table."  VALUES ('',".$values.") ";
			//if($this->query($SQL)){
				$this->query($SQL);
			//}else die("Error execution de la function insert de la base de donée !!");
		}
		public function update($table,$rowsUPDATE,$where){
				$SQL = "UPDATE ".$table." SET ".$rowsUPDATE." WHERE  ".$where." ";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("Error execution de function update de la base de donée !");
		}
		public function select($table,$where = ""){
				$SQL = "SELECT * FROM ".$table." ";
				if($where != "") $SQL .= " WHERE ".$where." ";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("Error execution de la function select de la base de donée");
		}
		public function deletes($table,$where){
				$SQL = "DELETE FROM ".$table." WHERE ".$where." ";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("Erreur execution de l afunction deletes de la base de donée !");
		}
		public function AddCLM($table,$clm,$value){
			$SQL = "ALTER TABLE ".$table." ".$clm." ".$value." ";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("erreur d'execution de la function AddCLM de la base de donée !");
		}
		public function create_table($name,$values){
			$SQL = "CREATE TABLE ".$name."(id int not null primary_key auto_increment ," .$values. " )";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("Erreur d'execution de la function create table !");
		}
		public function getinfo($selection){
			return $selection->fetch_array(MYSQLI_BOTH);
		}
		
	}
	


?>