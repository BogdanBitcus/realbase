<?php

	$query = "SELECT short_".$lang." FROM pages WHERE id='$id' LIMIT 1";
	$B = DB::fetchAssoc(DB::query($query));

	redirect($B["short_".$lang]);