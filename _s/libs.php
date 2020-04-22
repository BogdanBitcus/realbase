<?php

//$currency = "USD";
//$exchange_query_result = file_get_contents('https://blockchain.info/ru/ticker');
//$exchange_data_obj = json_decode($exchange_query_result);
//echo "USD in BTC: ".$exchange_data_obj->$currency->last."\n";

//$api_privatbank_curs = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
//$cours_data_obj = json_decode($api_privatbank_curs);
//echo "Privat24 USD : ".$cours_data_obj[2]->sale;
//$UAH_PER_BTC = round($cours_data_obj[2]->sale * $exchange_data_obj->$currency->last);

function clear_lang_in_url($url_array){
	global $langs_array;
	if(is_array($url_array)){
		foreach($url_array as $part_url){
			if(!in_array($part_url, $langs_array)){
				$url_without_lang .= "$part_url/";
			}
		}
	} else {
		exit('Error - code 1003');
	}
	return $url_without_lang;
}

function open_tpl($url='',$template='tpl',$id='1',$lang='ru'){

	if($template=='tpl'){
		$query = 'SELECT * FROM pages WHERE addr='.DB::quote($url); //ищем в базе такой addr
	} else {
		$query = 'SELECT * FROM pages WHERE id='.$id;
	}
	$I = DB::fetchAssoc(DB::query($query));
				
	// тянем с базы tpl
	$query = 'SELECT '.$template.' FROM types WHERE id="'.$I[type].'" LIMIT 1';
  	$tpl_file = DB::fetchAssoc(DB::query($query));

	// проверка и запуск файла
	if($template=='admin') {
		$file = EDIT_PATH.$tpl_file[$template];
	} else {
		$file = VIEW_PATH.$tpl_file[$template];
	}

	if (is_file($file)){
		include_once($file);
	} else {
		exit('Error - code 1002 (No template file)');
	}
}



function sign($str) {
	return md5(sha1($str.KEY_CRYPT));
}


function my_print_r($vars){
	echo "<pre>";
	print_r($vars);
	echo "</pre>";
	die();
}


function limit_words($s,$kol_words) {
	$o = explode(' ',$s);
	$s='';
	for($i=0;$i<$kol_words;$i++){
    	$s .= $o[$i].' ';
	}
	$s = trim($s);
	$s .= '...';
	return $s;
}


$month_days = array(
  "1"=>"31",
  "2"=>"28",
  "3"=>"31",
  "4"=>"30",
  "5"=>"31",
  "6"=>"30",
  "7"=>"31",
  "8"=>"31",
  "9"=>"30",
  "10"=>"31",
  "11"=>"30",
  "12"=>"31"
);


$month_array = array(
  'ru'=>array(
          "1"=>"Январь",
          "2"=>"Февраль",
          "3"=>"Март",
          "4"=>"Апрель",
          "5"=>"Май",
          "6"=>"Июнь",
          "7"=>"Июль",
          "8"=>"Август",
          "9"=>"Сентябрь",
          "10"=>"Октябрь",
          "11"=>"Ноябрь",
          "12"=>"Декабрь"
  ),
  'ua'=>array(
          "1"=>"Січень",
          "2"=>"Лютий",
          "3"=>"Березень",
          "4"=>"Квітень",
          "5"=>"Травень",
          "6"=>"Червень",
          "7"=>"Липень",
          "8"=>"Серпень",
          "9"=>"Вересень",
          "10"=>"Жовтень",
          "11"=>"Листопад",
          "12"=>"Грудень"
  ),
  'en'=>array(
          "1"=>"January",
          "2"=>"February",
          "3"=>"March",
          "4"=>"April",
          "5"=>"May",
          "6"=>"June",
          "7"=>"July",
          "8"=>"August",
          "9"=>"September",
          "10"=>"October",
          "11"=>"November",
          "12"=>"December"
  )
);


function datelang($date, $lang='ru') {

	if ('ua' == $lang) $translate=array(
                        "Jan"=>"ciчня",
                        "Feb"=>"лютого",
                        "Mar"=>"березня",
                        "Apr"=>"квiтня",
                        "May"=>"травня",
                        "Jun"=>"червня",
                        "Jul"=>"липня",
                        "Aug"=>"серпня",
                        "Sep"=>"вересня",
                        "Oct"=>"жовтня",
                        "Nov"=>"листопада",
                        "Dec"=>"грудня"
                        );

    if ('ru' == $lang) $translate=array(
                        "Jan"=>"января",
                        "Feb"=>"февраля",
                        "Mar"=>"марта",
                        "Apr"=>"апреля",
                        "May"=>"мая",
                        "Jun"=>"июня",
                        "Jul"=>"июля",
                        "Aug"=>"августа",
                        "Sep"=>"сентября",
                        "Oct"=>"октября",
                        "Nov"=>"ноября",
                        "Dec"=>"декабря"
                        );
    
	if ('en' == $lang) $translate=array(
                        "Jan"=>"January",
                        "Feb"=>"February",
                        "Mar"=>"March",
                        "Apr"=>"April",
                        "May"=>"May",
                        "Jun"=>"June",
                        "Jul"=>"July",
                        "Aug"=>"August",
                        "Sep"=>"September",
                        "Oct"=>"October",
                        "Nov"=>"November",
                        "Dec"=>"December"
                        );
        
    $date_list=exlode("[-\s:]",$date);
    $date_eng = date("d M Y", mktime ($date_list[5],$date_list[4],$date_list[3],$date_list[1],$date_list[2],$date_list[0]));
    foreach( $translate as $eng => $rus) {
        $date_eng = preg_replace("/$eng/",$rus,$date_eng);
    }
    $date_rus=$date_eng;

    $date_rus = preg_replace("/^0/","",$date_rus);
    return $date_rus;
}


function url($ida,$edit=0,$relocate=null) {//если !$edit в $ida лежит addr иначе $id
    global $lang;
    if($edit) {
    	$return="/$lang/edit/$ida/";
    	if($relocate) $return.="?relocate=".urlencode($relocate);
    } else $return="/$lang/$ida";
    return $return;
}


function percent($val1,$val2){
	$return=($val1/$val2)*100;
    return $return;
}


function redirect($url) {
	$url=urldecode($url);
	header ("Location: $url", 301);
	exit();
}


function digidate($date){
    $date=substr($date,0,10);
    $dd=explode("-",$date);
    $ret=$dd[2].".".$dd[1].".".$dd[0];
    return $ret;
}


function sitemap($id_s=1){
	global $lang;
	$query = "SELECT pages.* 
	FROM pages LEFT JOIN types ON pages.type=types.id 
	WHERE pages.parent='$id_s'
		AND pages.enable_$lang='1'
		AND types.tpl!=''
	ORDER BY pages.pos";
	$res_m=DB::query($query);
	echo "<ul class='sitemap'>";
	while($M_=DB::fetchAssoc($res_m)){
   		echo "<li><a href='".url($M_['addr'])."'>".$M_['name_'.$lang]."</a></li>";
        sitemap($M_['id']);
	}
	echo "</ul>";
}


function getpath(){//строит path текущей странички
	global $I;

	$parent=$I['parent'];
	$pathid[0]=$I['id'];
	$pathname[0]=$I['name'];
	$pathaddr[0]=$I['addr'];
	$path_a[0]=0;
	$query="SELECT * FROM pages where id='$parent'";
	$res=DB::query($query);
	$ind=1;
	while($P=DB::fetchAssoc($res)){
	 if($P['id']!=1){
	  $pathid[$ind]=$P['id'];
	  $pathname[$ind]=$P['name'];
	  $pathaddr[$ind]=$P['addr'];

	  //единичка - выводим потом с сылочкой, нолик - просто текстом

	  if ($P['type']==3 OR $P['type']==6 OR $P['id']==$I['id'])
	  	$path_a[$ind]=0;
	  else
	  	$path_a[$ind]=1;
	  	
	  $parent=$P['parent'];

	  $query="SELECT * FROM pages where id='$parent'";
	  $res=DB::query($query);

	  $ind++;
	 } else break;
	}
	$pathid=array_reverse($pathid);
	$pathname=array_reverse($pathname);
	$pathaddr=array_reverse($pathaddr);
	$path_a=array_reverse($path_a);

	$path="";
	$ind=0;
	foreach($pathid as $key=>$value){
	  if($ind==0) $quo="";
	  else $quo=">>";
	  //смотрим выводить ссылкой или неееет
	  if($path_a[$key]==1)
	  	$path.="$quo <a href=\"/$pathaddr[$key]\">$pathname[$key]</a> ";
	  else
	  	$path.="$quo $pathname[$key] ";
	  $ind++;
	}
	return $path;
}


function make_null($id){ //не трогать! системное!
	$query = "UPDATE pages SET addr='' WHERE id='$id'";
    DB::exec($query);
    $query = "SELECT * FROM pages WHERE parent='$id' ORDER BY pos";
	$res = DB::query($query);
    while($arr = DB::fetchAssoc($res)) {
		make_null($arr['id']);
	}
}


function make_addr(){
 	$query="SELECT id FROM pages WHERE addr='' ORDER BY id";
 	$res=DB::query($query);
 	$ind=0;
 	while($resf = DB::fetchAssoc($res)){
 	  $NO_ADDR[$ind]=$resf['id'];
 	  $ind++;
 	}
 	if($NO_ADDR){
	 	foreach($NO_ADDR as $value){
	 	  $id=$value;
	 	  $query="SELECT url,parent FROM pages WHERE id='$id'";
	 	  $url = DB::fetchAssoc(DB::query($query));
	 	  $URLS = array();
	 	  $URLS[0] = $url['url'];
	 	  $ind=1;
	 	  $PARENT = $url['parent'];
	 	  while($url = DB::fetchAssoc(DB::query("SELECT url,parent FROM pages WHERE id='$PARENT'"))) {
	 	      if($url['url']!='') $URLS[]=$url['url'];
	 	      $PARENT = $url['parent'];
	 	      $ind++;
	 	  }
	 	  $URLS_R = array_reverse($URLS);
	 	  $addr='';
	 	  foreach($URLS_R as $key => $value) if($value!='') $addr.=$value."/";
	 	  $query="UPDATE pages SET addr='$addr' WHERE id='$id'";
	 	  DB::exec($query);
		}
	}
}


function checkAJAX () {
    // checking ...
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
    {
        // да Это действительно AJAX  :)    
        return true;    
    }
    // :(
    return false;
}

function generate_pass($number) {
    //$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0','.',',','(',')','[',']','!','?','&','^','%','@','*','$','<','>','/','|','+','-','{','}','`','~','_');
    $arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0','_');
    $pass = "";
    for($i = 0; $i < $number; $i++) {
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
}


function get_duration ($date_from, $date_till) {
	$date_from_h = explode(' ', $date_from);
	$date_till_h = explode(' ', $date_till);
	
	$date_from = explode('-', $date_from_h[0]);
	$date_till = explode('-', $date_till_h[0]);

	$time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
	$time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);

	$diff = ($time_till - $time_from)/60/60/24;
	//$diff = date('d', $diff); - как делал))

	return $diff;
}