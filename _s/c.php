<?

	session_start();
	
	
	header('Content-Type: text/html; charset=utf-8');
	
	
// Для разработки
	error_reporting(E_ALL ^ E_NOTICE);// ^ E_STRICT); // E_STRICT - строгий контроль / Off
// Для работы
	//error_reporting(0);

	// DB connection
	define(DB_HOST, 'localhost');
	define(DB_USER, 'realbase');
	define(DB_PASS, 'Bl1n4ik1');
	define(DB_NAME, 'realbase');
	
	define(URL_ROOT, $_SERVER['DOCUMENT_ROOT']);
	define(SYS_PATH, URL_ROOT.'/_s/');
	define(VIEW_PATH, URL_ROOT.'/view/');
	
	define(LANG_DEFAUL, 'ru');
	$lang = htmlspecialchars( $_REQUEST['lang'] ? $_REQUEST['lang'] : LANG_DEFAUL );

	define(KEY_CRYPT, 's0m< $H!T каКА ї'.chr(254));
	define(KEY_COOKIES, '+/50d096dc2bd097jhd44a/+');


	include_once(SYS_PATH."db.php");
	DB::getInstance();
	
	
	include_once(SYS_PATH."langs.php");


	include_once(SYS_PATH."libs.php");


?>