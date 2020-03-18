<?php
// SEO START
	
	if (substr($_SERVER['SERVER_NAME'], 0, 4) === 'www.') {
		header("HTTP/1.1 301 Moved Permanently");
	    header('Location: http://' . substr($_SERVER['SERVER_NAME'],4) . $_SERVER['REQUEST_URI']);
	    exit();
	}
	
	//////////////////// добавляем слеш в конец ///////////////////////
	if (preg_match('/[?]/', $_SERVER['REQUEST_URI'])) { // если есть параметры
		list($s_url,$s_params) = explode("?",$_SERVER['REQUEST_URI']);
		if (preg_match('/\/$/', $s_url)) { // если есть слеш в конце
			// - 
		} else { // или если нету слеша
			if($s_params){ // если естьпараметры
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://".$_SERVER['SERVER_NAME'].strtolower($s_url)."/?".$s_params);
				exit();
			} else { // если нету параметров
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://".$_SERVER['SERVER_NAME'].strtolower($s_url)."/");
				exit();
			}
		}
	} else { // если нету параметров
		if (preg_match('/\/$/', $_SERVER['REQUEST_URI'])) { // если есть слеш
			// -
		} else { // нету слеша
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: http://".$_SERVER['SERVER_NAME'].strtolower($_SERVER['REQUEST_URI'])."/");
			exit();
		}
	}
	
	//////////////////////////// в адресной строке большие буквы /////////////////////////////
	if (preg_match('/[A-Z]/', $_SERVER['REQUEST_URI'])) { // если есть большие буквы
	
		if (preg_match('/[?]/', $_SERVER['REQUEST_URI'])) { // если есть параметры
			list($stat,$params) = explode("?",$_SERVER['REQUEST_URI']);
		} else { // без параметров
			$stat = $_SERVER['REQUEST_URI'];
		}
		if (preg_match('/[A-Z]/', $stat)) { // если есть большие буквы
			if($params){ // если есть параметры
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://".$_SERVER['SERVER_NAME'].strtolower($stat)."?".$params);
				exit();
			} else { // параметров нету
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://".$_SERVER['SERVER_NAME'].strtolower($stat));
				exit();
			}
		}
		
	}
	
// SEO END