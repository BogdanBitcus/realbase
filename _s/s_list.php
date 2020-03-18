<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");

    $table = htmlspecialchars($_REQUEST['table']);
    if (!$table) $table='pages';
    $position = $_REQUEST['position'];
    $relocate = $_REQUEST['relocate'];
    $id = (int) $_REQUEST['id'];
    
    
    if (is_array($position)) { // сохраняем список
	     asort($position, SORT_NUMERIC);
	     reset($position);

	     $o = 0;
	     foreach($position as $i => $v) {
			$o+=10;
			$query = "UPDATE $table SET pos='$o' ";
			foreach ($_REQUEST as $key => $value){
				if (preg_match("/.*_s_$i$/",$key)){
					$key = preg_replace("/_s_$i$/","",$key);
					$query .= ", $key=".DB::quote($value)."";
				}
				if (preg_match("/.*_h_$i$/",$key)){
					$key = preg_replace("/_h_$i$/","",$key);
					$query .= ", $key=".DB::quote($value)."";
				}
			}
			$query .= " WHERE id='$i'";
			DB::exec($query);
			if(isset($_REQUEST["addr_s_$i"]) && $_REQUEST["addr_s_$i"]=='') { make_null($i); }
	     }
    }



    if ($id) { // остальная инфа на страничке
        $query = "UPDATE $table SET id='".$id."' ";

        foreach ($_REQUEST as $key => $value) {
	       if (preg_match("/.*_s$/",$key)){
	           $key=preg_replace("/_s$/","",$key);
	           $query .= ", $key=".DB::quote($value)."";
	       }
		}
        $query .= " WHERE id='".$id."'";
        DB::exec($query);
        if(isset($_REQUEST["addr_s"]) && $_REQUEST["addr_s"]=='') { make_null($id); }
    }

    make_addr();
    redirect($relocate);
?>