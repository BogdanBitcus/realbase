<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	

    $id = (int) $_REQUEST['id'];
    $table = htmlspecialchars($_REQUEST['table']);
    if (!$table) $table='pages';
    $relocate = htmlspecialchars($_REQUEST['relocate']);

  
	$query = "DELETE FROM $table WHERE id='$id'";//удаляется только текущая запись
	DB::exec($query);


	redirect($relocate);
?>