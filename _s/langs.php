<?php

	
	$langs_array = array('ru','ua','en');
	
	$lang = $lang ? $lang : LANG_DEFAUL;
	
	$query = "SELECT alias,".$lang." FROM langs";
	$res = DB::query($query);
	while($l = DB::fetchAssoc($res)){
		$langs[$l['alias']] = $l[$lang];
	}