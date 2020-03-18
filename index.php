<?

$start_microtime = microtime(true);

	include_once($_SERVER['DOCUMENT_ROOT']."/_s/defence.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/seo.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");	
	
	$url = DB::quote( $_REQUEST['url'] ? $_REQUEST['url'] : '' );
	$edit = (int) $_REQUEST['edit'];
	$id = (int) $_REQUEST['id'];
	
	//print_r($_REQUEST);
	
if ($edit == 1) { // админка
	
	include_once(SYS_PATH."auth.php"); // доступ после авторизации
	
	if($id>0){
		$query = "SELECT * FROM pages WHERE id=$id";
		$I = DB::fetchAssoc(DB::query($query));
	} else {
		exit(':)');
	}
	
} else { // рабочая/публичная часть сайта
	
	$query = "SELECT * FROM pages WHERE addr=$url"; //ищем в базе такой addr
	$I = DB::fetchAssoc(DB::query($query));
}



	// тянем с базы tpl
	$template = $edit ? 'admin' : 'tpl';
	$query = "SELECT $template FROM types WHERE id='$I[type]' LIMIT 1";
  	$tpl_file = DB::fetchAssoc(DB::query($query));

	// проверка и запуск файла
	$file = VIEW_PATH.$tpl_file[$template];
	if (is_file($file)){
		include_once($file);
	} else {
		header("HTTP/1.0 404 Not Found");
		include_once(VIEW_PATH."view.404.php");
		exit();
	}
	
$time = microtime(true) - $start_microtime;
//printf ('<!--Скрипт выполнялся %.4F сек.-->', $time);

?>