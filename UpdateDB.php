
<?PHP

	$select_voy = $db->select("voyageurs");
	$select_cond = $db->select("cond");
	if($select_voy){
	while($fetch_voy = $db->getinfo($select_voy)){
		if($fetch_voy["date"] < $date) 
			$db->deletes("voyageurs"," id='".$fetch_voy["id"]."' ");
		else continue;
	}
	}
	if($select_cond){
	while($fetch_cond = $db->getinfo($select_cond)){
		if($fetch_cond["date"] < $date) 
			$db->deletes("cond"," id_cond='".$fetch_cond["id_cond"]."' ");
		else continue;
	}
	}
?>
