<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	
  
  $table = htmlspecialchars($_REQUEST['table']);
  if (!$table) $table='pages';
  $relocate = htmlspecialchars($_REQUEST['relocate']);
  $parent = (int) $_REQUEST['parent'];
  $pos = (int) $_REQUEST['pos'];
  if (!$parent) $parent = 0;
  $pieces_fields = array();
  $pieces_values = array();
  
  
  
  if($parent){
  	$query = "SELECT * FROM $table WHERE parent='$parent' LIMIT 1";
  } else {
  	$query = "SELECT * FROM $table LIMIT 1";
  }
  $res=DB::query($query);
  

  if (DB::numRows($res) > 0){
  	$arr = DB::fetchAssoc($res);
  } else {
  	if($pos || $parent){
		$arr = array("pos" => $pos, "parent" => $parent);
  	} else {
  		$arr = array();
  	}
  }

	if(is_array($arr))
	foreach ($arr as $key => $value){
		if (preg_match("/[a-z]/i", $key) && ($key != 'id') && ($key != 'url')) {
			array_push($pieces_fields,"$key");
			array_push($pieces_values,"'".addslashes($_REQUEST[$key] ? $_REQUEST[$key] : $value)."'");
		}
	}

  $query="INSERT INTO $table(".join(",",$pieces_fields).") VALUES(".join(",",$pieces_values).")";
  DB::exec($query);


  
  if (!$relocate) {
    $relocate = "/ru/edit/1/";
  }
  
	redirect($relocate);
?>