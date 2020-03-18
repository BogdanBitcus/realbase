<?php
	
	
	$query = "SELECT alias,".$lang." FROM langs";
	$res = DB::query($query);
	while($l = DB::fetchAssoc($res)){
		$langs[$l['alias']] = $l[$lang];
	}