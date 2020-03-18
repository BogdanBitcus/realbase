<?
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	
	if(!checkAJAX()) exit(':)');
	
	$results_json = array('results' => '0');
	/*
	$otv = (int) $_REQUEST['otv'];
	$vopr = (int) $_REQUEST['vopr'];
	
	$query = "SELECT name_".$lang.",short_".$lang." FROM pages WHERE id='$vopr' AND type='17' AND enable_".$lang."='1' LIMIT 1";
	$vopr_inf = DB::fetchAssoc(DB::query($query));
	*/

$results_json = array(
	'results' => '1',
	'html' => $html_results
);

echo json_encode($results_json);
