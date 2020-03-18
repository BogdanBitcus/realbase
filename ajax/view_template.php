<?php
include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	
	if(!checkAJAX()) exit(':)');
	
	$id_tpl = filter_var(trim($_GET['tpl']), FILTER_VALIDATE_INT);

	if (empty($id_tpl)) return false;

	$sql = DB::query("SELECT * FROM types WHERE `id` = ".$id_tpl."");
	$row = DB::fetchAssoc($sql);

	$result = 0;
	if(!empty($row)) { $result = 1; }
 
	echo json_encode(array(
	    'res'   => $result,
	    'edit'  => $row['admin'],
	    'view'  => $row['tpl'],
	    'name_view' => $row['name']
	));

	exit;