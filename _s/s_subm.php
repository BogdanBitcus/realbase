<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	
/*
   ** $_REQUEST only! **
   $table - куда записать
   $id - если апдейтить
   $.._s - значение (string)
   $.._h - htmltext (заменить абсолютные урлы атносительными)
   $.._a - array - записывает значения через запятую
   $relocate - куда перенаправить после того, как сохранили. 

   $.._b - набор булевых значений - их нужно сбросить в одну строку
   $.._t - масив для serialize()
   $.._i - масив для implode(',',$array)
*/

  $table = htmlspecialchars($_REQUEST['table']);
  if (!$table) $table='pages';
  $id = (int) $_REQUEST['id'];
  $relocate = $_REQUEST['relocate'];

  

  $pieces=array();
  $pieces_fields=array();
  $pieces_values=array();
  $data_to_save=array();
  
	$value2="";
	
	foreach ($_REQUEST as $key => $value) {
		if (preg_match("/.*\_b$/",$key)){
		    $key2=preg_replace("/\_..\_b$/","",$key);
		    if($value2!="") $value2.=",$value";else $value2.="$value";
		}            
		if (preg_match("/.*\_s$/",$key)){
		    $key=preg_replace("/\_s$/","",$key);
		    $data_to_save[$key]=DB::quote($value);
		}
		if (preg_match("/.*\_h$/",$key)){
		    $key=preg_replace("/\_h$/","",$key);
			$value=preg_replace("|http://$_SERVER[HTTP_HOST]/|","/",$value);
		    $data_to_save[$key]=DB::quote($value);
		}
		if (preg_match("/.*\_a$/",$key)){
		    $key=preg_replace("/\_a$/","",$key);
		    if (is_array($value)) $data_to_save[$key]="'".join(',',$value)."'";
		}
		if (preg_match("/.*\_t$/",$key)){  
		    $key=preg_replace("/\_t$/","",$key); 
		    if (is_array($value)) $data_to_save[$key] = "'".serialize($value)."'";
		}            
		if (preg_match("/.*\_i$/",$key)){  
		    $key=preg_replace("/\_i$/","",$key); 
		    if (is_array($value)) $data_to_save[$key] = "'".implode('|:|',$value)."'";
		}
	}
	if($key2 && $value2) $data_to_save[$key2]="'".$value2."'";



	if ($id) {
       foreach ($data_to_save as $key => $value) {
               array_push($pieces," $key=$value ");
       }
       $query="UPDATE $table SET ".join(",",$pieces)." WHERE id='$id'";
	} else {
		foreach ($data_to_save as $key => $value)
          if (preg_match("/\w/", $key )) {
               array_push($pieces_fields,"$key");
               array_push($pieces_values,"$value");
          }
		$query="INSERT INTO $table(".join(",",$pieces_fields).") VALUES(".join(",",$pieces_values).")";
  	}
	DB::exec($query);


  //проставляем id в релокейт
  if(!$id) {
     $query = "SELECT LAST_INSERT_ID() FROM $table";
     list($id) = mysql_fetch_row(mysql_query($query));
  }	

  if (!$relocate) {
    $relocate = url(1,1);
  } else {
    $relocate = str_replace('{id}',$id,$relocate);
  }

  if($table=='pages'){
	if(isset($_REQUEST['addr_s']) && $_REQUEST['addr_s']=='') { make_null($id); }
	make_addr();
  }

  redirect($relocate);
