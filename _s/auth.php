<?php

//print_r($_GET);//exit();
//print_r($_SESSION);

if($_GET['logout'] == 1) { // выходим

	unset($_SESSION['_auth']);
	unset($_SESSION['_auth_id']);
    unset($_SESSION['_auth_fio']);
    unset($_SESSION['_auth_r_ids']);
    unset($_SESSION['_auth_r_types']);
	header("Location:/admin/");
	exit();
}

//print_r($_SESSION);


	$_log = trim(htmlspecialchars($_POST['_log']));
	$_pas = trim(htmlspecialchars($_POST['_pas']));
	$logged = 0;
	$_auth_error = 0;
	
if ($_SESSION['_auth']) {
//	echo "is _auth true";
	// -
	
} else if ($_log!='' && $_pas!=''){

	$res_pass = DB::query("SELECT id,fio,pass,r_ids,r_types FROM admins WHERE log='$_log' AND enable='1' LIMIT 1");
	if(DB::numRows($res_pass)){
		
		$user = DB::fetchAssoc($res_pass);
		if($user['pass'] == sign($_pas)){
			
      		$_SESSION['_auth_id'] = $user['id'];
      		$_SESSION['_auth_fio'] = $user['fio'];
      		$_SESSION['_auth_r_ids'] = explode(",",$user['r_ids']);
      		$_SESSION['_auth_r_types'] = explode(",",$user['r_types']);
	    	$_SESSION['_auth'] = 1;
		}
	} else {
		$_auth_error=1;
	}
	
}

if (!$_SESSION['_auth']) {?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ADMINZONE</title>
<script>
function focuuss()
	{document.forms['_auth']._log.focus();}
</script>
</head>
<body style='background:url("/public/img/admin/login_cms/body_bg.jpg") repeat-x 0px 0px;padding:0px;margin:0px;'  onLoad='focuuss();'>
	<form method=POST name='_auth' action="">
		<div style='width:600px;height:100px;margin:200px auto 0 auto;'>
			<div style='margin:0px 0px 10px 0px;'><input type='text' value='<?=$l_value?>' name='_log' placeholder="Логин" style='width:100%;border:1px solid #808080;'></div>
			<div style='margin:0px 0px 10px 0px;'><input type='password' value='<?=$p_value?>' name='_pas' placeholder="Пароль" style='width:100%;border:1px solid #808080;'></div>
			<div style='margin:0px 0px 10px 0px;'><input type='submit' style='width:100%;' value='Войти'></div>
		<? if($_auth_error==1){ ?><p style='color:red;'>Не правильный пароль!</p><?}?>
		</div>
	</form>
</body>
</html>
<? die(); }?>