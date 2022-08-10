<?PHP
	class database extends mysqli{
		function __construct($server,$user,$password,$dbName){
			return parent::__construct($server,$user,$password,$dbName);
		}
		public function insert($table,$values){
				$SQL = "INSERT INTO ".$table."  VALUES ('',".$values.") ";
			
				$this->query($SQL);
			
		}
		public function update($table,$rowsUPDATE,$where){
				$SQL = "UPDATE ".$table." SET ".$rowsUPDATE." WHERE  ".$where." ";
				
				$this->query($SQL);
			
		}
		public function select($table,$where = "",$limit = ""){
				$SQL = "SELECT * FROM ".$table." ";
				if($where != "") $SQL .= " WHERE ".$where." ";
				if($limit !="") $SQL .= " LIMIT ".$limit." ";
				if($this->query($SQL)){
				return $this->query($SQL);
			}else die("Error execution de la function select de la base de donée");
		}
		public function deletes($table,$where){
				$SQL = "DELETE FROM ".$table." WHERE ".$where." ";
				$this->query($SQL);
		}
		public function AddCLM($table,$clm,$value){
			$SQL = "ALTER TABLE ".$table." ".$clm." ".$value." ";
				
				 $this->query($SQL);
		}
		public function create_table($name,$values){
			$SQL = "CREATE TABLE ".$name."(id int not null PRIMARY KEY AUTO_INCREMENT ," .$values. " )";
				
				 $this->query($SQL);
			
		}
		public function getinfo($selection){
			return $selection->fetch_array(MYSQLI_BOTH);
		}
		
		
	}
	


?>