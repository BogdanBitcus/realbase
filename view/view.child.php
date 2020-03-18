<?php

	$query = "SELECT id, addr 
		FROM pages 
		WHERE 
			parent='$id'
			AND enable_$lang='1'
		ORDER BY pos
		LIMIT 1";
		
    $I = DB::fetchAssoc(DB::query($query));
    
	header("Location: /".$lang."/".$I['addr'] , 301);
	exit();