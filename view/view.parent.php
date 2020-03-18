<?php

	$query = "SELECT t_parent.addr
		FROM pages as t_parent,
			pages as t_current
		WHERE
			t_current.id = '$id'
			AND t_current.parent = t_parent.id
		LIMIT 1";
		
	$P = DB::fetchAssoc(DB::query($query));

	header("Location: /".$lang."/".$P['addr'], 301);
	exit();