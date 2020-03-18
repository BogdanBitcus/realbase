<?php 

	$error_exit = 0;
	$secretKey = "6Lc9wCkTAAAAAJFrz-pu6_O1nabuH6bKe8d6dqwA";
    $ip = $_SERVER['REMOTE_ADDR'];
    $email = htmlspecialchars($_REQUEST['email']);
	$password = sign($_REQUEST['password']);
	
	
	if(isset($_GET['akt_key'])){
		
		$akt_key = htmlspecialchars($_GET['akt_key']);
		$query = "SELECT id FROM users WHERE activate='0' AND sign_user='".$akt_key."' LIMIT 1";
		$res = DB::query($query);
		if(DB::numRows($res)>0){
			$query = "UPDATE users SET
					activate = '1'
					WHERE sign_user='$akt_key'
					LIMIT 1
				";
				if(DB::exec($query)){
					$error_echo = 'Cпасибо! Ваш E-mail подтвержден';
	        		$error_exit = 1;
				} else {
					$error_echo = 'Ошибка активации E-mail. Обратитесь в поддержку';
	        		$error_exit = 1;
				}
		} else {
			$error_echo = 'Ошибка активации E-mail. Или Ваш E-mail уже подтвержден.';
	        $error_exit = 1;
		}
		
	}
	
	
	
    if(isset($_POST['g-recaptcha-response']) || isset($_REQUEST['login_form_hidden']) || $_REQUEST['login_form_hidden']==1){
	
		$captcha = $_POST['g-recaptcha-response'];
        if(!$captcha){
        	
          $error_echo = 'Пройдите проверку "Я не робот"';
          $error_exit = 1;
          
        } else {
        	
        	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        	$responseKeys = json_decode($response,true);
        	
        	if(intval($responseKeys["success"]) !== 1) {
        		
	          $error_echo = 'Ошибка. Повторите попытку';
	          $error_exit = 1;
	          
	        } else {
		
				$query = "SELECT *
					FROM users
					WHERE
						email = '$email' 
						AND password = '$password'
						AND activate = '1'
					LIMIT 1
				";
				$res = DB::query($query);
				if(DB::numRows($res)>0){
					$user = DB::fetchAssoc($res);
					$_SESSION['id_user'] = $user['id'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
					$_SESSION['wallet'] = $user['wallet'];
					$_SESSION['phone'] = $user['phone'];
					$_SESSION['sign_user'] = $user['sign_user'];
					
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: http://".$_SERVER['SERVER_NAME']."/".$lang."/cabinet/");
					exit();
				} else {
					$error_echo = 'Ошибка!<br>Пользователя с таким логином или паролем не существует или E-mail не подтвержден';
			        $error_exit = 1;
				}
			}
		}
	}

$include = 'header'; include(VIEW_PATH."borders.index.php"); ?>

	<div class='obmen'>
		<div class='divcenter clear'>
			<div class='form' style='padding:10px 40px;'>
				
			<h1><?=$I['name_'.$lang]?></h1>
      		<?=$I['html_'.$lang]?>
      		
      			<form name='login_form' id='login_form' action='' method="post">
	      			<input type="hidden" name='login_form_hidden' value="1">
	      			<?if($error_exit){
	      				echo "<p class='error_text'>".$error_echo."<a href='javascript:void(0);' class='close_error'></a></p>";
	      			}?>
	      			<table class='table_form'>
	      			<tr><td>Email:</td><td><input type="email" name='email'></td></tr>
	      			<tr><td>Пароль:</td><td><input type="password" name='password'></td></tr>
	      			</table>
	      			<br>
	      			<div class="g-recaptcha" data-sitekey="6Lc9wCkTAAAAAIYAafY-ufsHn6rmb6GrM_gSLp92"></div>
	      			<input type='submit' class='idei' value="Войти">
	      		</form>
	      		<div class='clear'>
					<p>
						<a href='/<?=$lang?>/registration/'>Регистрация</a>
						<br>
						<a href='/<?=$lang?>/recovery/'>Забыли пароль?</a>
					</p>
				</div>
			</div>
			
		</div>
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>