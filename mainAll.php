<?PHP

	class MAIN{
			private $data;
		function __construct($db){
			$this->data = $db;
		}
		public function member($id,$choice = ""){
			$select_members = $this->data->select("insp", " id='".intval($id)."'");
			$getInfo_mem = $this->data->getinfo($select_members);
			if($choice != "") return $getInfo_mem[$choice];
			else return $getInfo_mem;
		}
		public function connected_member($email,$choice = ""){
			$select_members = $this->data->select("insp", " email='".$email."'");
			$getInfo_mem = $this->data->getinfo($select_members);
			if($choice != "") return $getInfo_mem[$choice];
			else return $getInfo_mem;
		}
		public function change_info_cond($id,$update){
			$select = $this->data->select("cond", " id_cond='".intval($id)."' ");
			if($this->data->getinfo($select_members) !== false){
				
			}else die("row doesn't exist in condiction table !");
		}
		public function verifType($id,$fumeur,$radio,$disc){
			$mem = $this->member($id);
				$mem_fum = $mem["fummeur"];
				$mem_rad = $mem["radio"];
				$mem_disc = $mem["dusc"];
			if($mem_fum == $fumeur && $mem_rad == $radio && $mem_disc == $disc){
				return " style = 'background:#B0FFAF;' ";
			}else if($mem_fum == $fumeur && $mem_rad == $radio && $mem_disc != $disc){
				return  " style = 'background:#FFFECC;' ";
			}else if($mem_fum == $fumeur && $mem_rad != $radio && $mem_disc == $disc){
				return " style = 'background:#FFFECC;' ";
			}else if($mem_fum != $fumeur && $mem_rad == $radio && $mem_disc == $disc){
				return " style = 'background:#FFFECC;' ";
			}else {
				return " style = 'background:#fff;' ";
			}
		}
		public function existTraj($type,$idTrj,$id){
			switch($type){
				case "voyageur": 
					$select_voy = $this->data->select("voyageurs"," id_condiction = '".$idTrj."' and id_voyageur='".$id."' ");
					if($select_voy->num_rows != 0){
						return true;
					}else return false;
				break;
				case "condicteur": 
					$select_cond = $this->data->select("cond"," id_cond='".$idTrj."' and id='".$id."' ");
					if($select_cond->num_rows != 0){
						return true;
					}else return false;
				break;
			}
		}
		public function div($msg,$tp,$loc = ""){
			if($tp == "t"){
				$id = "green";
			}else if($tp == "f"){
				$id = "red";
			}else if($tp == "s"){
				$id = "yellow";
			}
			echo '
			<center>';
				if($loc != "") 
				echo '<div class="loader"></div><script type="text/javascript">redirects("'.$loc.'");</script>';
				echo'<span class="'.$id.'">'.$msg.'</span>';
			echo '</center>
			';
		}
		public function redirect($url){
			header("Location: ".$url);
		}
		public function TrjExistDay($TrjId,$MemID,$TrjDATE){
			$selection = $this->data->select("cond"," id_cond='".$TrjId."' and id='".$MemID."' and date='".$TrjDATE."' ");
			if($selection->num_rows != 0){
				return true;
			}else return false;
		}
	}



?>