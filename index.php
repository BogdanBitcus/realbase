<?
$start_microtime = microtime(true);

	include_once($_SERVER['DOCUMENT_ROOT']."/_s/defence.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/seo.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");

	$url = !isset($_GET['url']) ? 'home_page' : $_GET['url'];
    
    $url_trim = rtrim($url, '/');
    $url_array = explode('/', $url_trim);
    
    
    if($url_array[0] == 'admin'){ // enter to CMS
		
		Header("Location:/".LANG_DEFAUL."/edit/1/", true, 301);
		
	} else if(in_array($url_array[0], $langs_array)){ // standart LANG enter
	
		$lang = $url_array[0];//other lang
		
        if ($url_array[0] == LANG_DEFAUL && !isset($url_array[1])) { // clear /lang/ for SEO
            Header("Location:/", true, 301);
        }
        
        if($url_array[1]=='edit'){ // CMS
    		include_once(SYS_PATH."auth.php"); // доступ после авторизации
			
			if(isset($url_array[2]) && $url_array[2]>0){
				open_tpl($url,'admin',$url_array[2],$lang);
			} else {
				exit('Error: cod - 1001');
			}
        } else { // view site part
        	$url_without_lang = clear_lang_in_url($url_array);
        	open_tpl($url_without_lang,'tpl',1,$lang);
		}
    } else { // other enter && 404
        if ($url_array[0] == "home_page") { // Main Page
            open_tpl('','tpl',1);
        } elseif(is_file(VIEW_PATH.'view.'.$url_array[0].'.php') && isset($url_array[1])) { // get tpl for flat
        	$id = $url_array[1];
        	include_once(VIEW_PATH.'view.'.$url_array[0].'.php');
        } else {
            header("HTTP/1.0 404 Not Found");
			include_once(VIEW_PATH.'view.404.php');
			exit();
        }
    }


$time = microtime(true) - $start_microtime; //printf ('<!--Скрипт выполнялся %.4F сек.-->', $time);
?>