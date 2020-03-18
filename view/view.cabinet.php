<?php 

	/*if($_SESSION['id_user']>0){
		
	} else {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: http://".$_SERVER['SERVER_NAME']."/".$lang."/login/");
		exit();
	}*/

	$error_exit = 0;
    $name = htmlspecialchars($_REQUEST['name']);
	$phone = htmlspecialchars($_REQUEST['phone']);
	$sign_user = htmlspecialchars($_REQUEST['sign_user']);

	if(isset($_REQUEST['update_form_hidden']) || $_REQUEST['update_form_hidden']==1){

		if($_REQUEST['password']!='' && $_REQUEST['password2']!=''){
			if($_REQUEST['password'] == $_REQUEST['password2']){
				$password = sign($_REQUEST['password']);
				$pass = "password = '$password',";
			} else {
				$error_echo = 'Ошибка! Введите верно Ваш пароль.';
      			$error_exit = 1;
			}
		}

		$query = "UPDATE users SET
			".$pass."
			name = '$name',
			phone = '$phone'
			WHERE sign_user='$sign_user'
		";
		if(DB::exec($query)){
			$_SESSION['name'] = $name;
			$_SESSION['phone'] = $phone;
			$error_echo = 'Данные обновлены';
      		$error_exit = 1;
		} else {
			$error_echo = 'Ошибка. Обратитесь к разработчикам.';
      		$error_exit = 1;
		}
	}

$include = 'header'; include(VIEW_PATH."borders.index.php"); ?>

	<div class='obmen clear'>
		<div class='divcenter '>
			<div class='form' style='padding:10px 40px;'>
				
			<h1><?=$I['name_'.$lang]?></h1>
      		<?=$I['html_'.$lang]?>      		
      		
      		<a href='/' class='idei check_click'>Переход на главную</a>
      		<br><br><br>
      		<script>
	(function(){
		$('.check_click').click(function(){
			window.parent.postMessage($(this).attr('href'), '*');
			//window.parent.postMessage(JSON.stringify({data:'close-realbase'}), '*');
		});
		
	})();
	</script>
      		
      			<form name='update_form' id='update_form' action='' method="post">
	      			<input type="hidden" name='update_form_hidden' value="1">
	      			<input type="hidden" name='sign_user' value="<?=$_SESSION['sign_user']?>">
	      			<?if($error_exit){
	      				echo "<p class='error_text'>".$error_echo."<a href='javascript:void(0);' class='close_error'></a></p>";
	      			}?>
	      			<table class='table_form'>
	      			<tr><td>Email(логин):</td><td><?=$_SESSION['email']?></td></tr>
	      			<tr><td>Имя:</td><td><input type="text" name='name' placeholder="<?=$_SESSION['name']?>" value="<?=$_SESSION['name']?>"></td></tr>
	      			<tr><td>Кошелек Bitcoin:</td><td><input type="text" name='wallet' placeholder="<?=$_SESSION['wallet']?>" value="<?=$_SESSION['wallet']?>"></td></tr>
	      			<tr><td>Телефон:</td><td><input type="text" name='phone' placeholder="<?=$_SESSION['phone']?>" value="<?=$_SESSION['phone']?>"></td></tr>
	      			<tr><td>Пароль:</td><td><input type="password" name='password' value=''></td></tr>
	      			<tr><td>Пароль еще разок:</td><td><input type="password" name='password2' value=''></td></tr>
	      			</table>
	      			<div class="g-recaptcha" data-sitekey="6LcAuSkTAAAAAG6euTXejA2fN35dsoE3j18cbizh"></div>
	      			<input type='submit' class='idei' value="Обновить">
	      			
	      		</form>
	      		<div class='clear'>Реферальная <a href='http://<?=$_SERVER['SERVER_NAME']?>/<?=$lang?>/registration/?ref=<?=$_SESSION['sign_user']?>'>ссылка</a></div>
			</div>
			
		</div>
		
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>