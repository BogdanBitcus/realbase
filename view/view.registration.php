<?php

	$error_exit = 0;
	$secretKey = "6LecqCkTAAAAALTCbRL0OLRuoEDR-hNuztlnoDEC";
    $ip = $_SERVER['REMOTE_ADDR'];
    $email = htmlspecialchars($_REQUEST['email']);
	$password = sign($_REQUEST['password']);
	$password2 = sign($_REQUEST['password2']);
	$wallet = htmlspecialchars($_REQUEST['wallet']);
	$sign_user = sign($email);
	$termsandconditions = (int) $_REQUEST['termsandconditions'];
	$parent = (int) $_REQUEST['parent'];
	$parent_ref = 0;
	
	
	if(isset($_GET['ref'])){
		
		$ref = htmlspecialchars($_GET['ref']);
		$query = "SELECT id,email FROM users WHERE sign_user='".$ref."' LIMIT 1";
		$res = DB::query($query);
		if(DB::numRows($res)>0){
				$ref = DB::fetchAssoc($res);
				$parent_ref = $ref['id'];
				$parent_ref_email = $ref['email'];
		} else {
			$error_echo = 'Ошибка. Обратитесь к администраторам.';
	        $error_exit = 1;
		}
		
	}
    
    
    if(isset($_POST['g-recaptcha-response']) || isset($_REQUEST['registration_form_hidden']) || $_REQUEST['registration_form_hidden']==1){
    	
        $captcha = $_POST['g-recaptcha-response'];
        if(!$captcha){
        	
          $error_echo = 'Пройдите проверку "Я не робот"';
          $error_exit = 1;
          
        } else {
        	
        	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        	$responseKeys = json_decode($response,true);
        	
        	if(intval($responseKeys["success"]) !== 1) {
        		
	          $error_echo = 'Ошибка. Повторите попытку регистрации';
	          $error_exit = 1;
	          
	        } else {
	        	
	        	if($termsandconditions === 1){
	        		
	        		$query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
		        	$res = DB::query($query);
		        	if(DB::numRows($res)>0){
						
						$error_echo = 'Пользователь с таким email уже зарегистрирован. <a href="/'.$lang.'/login/">Войдите</a> в свой аккаунт.';
		          		$error_exit = 1;
		          		
					} else {
					
						if($password == $password2){
							
							$query = "INSERT INTO users SET
								parent = '$parent',
								email = '$email',
								password = '$password',
								wallet = '$wallet',
								sign_user = '$sign_user'
							";
							if(DB::exec($query)){
								
								$message = '<html>
											<head>
											  <title>Letter From Bitcus</title>
											</head>
											<body>
											  <table>
											    <tr>
											      <td>Здравствуйте,<br> Подтвердите Ваш E-mail перейдя по <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$lang.'/login/?akt_key='.$sign_user.'">ссылке</a></td>
											    </tr>
											    <tr>
											      <td>Помните Ваш пароль и логин. В нас он хранится в зашифрованном виде.</td>
											    </tr>
											    <tr>
											      <td><br>Письмо отправлено автоматически, не отвечайте на него ;)<br><br> С уважением,<br> Администрация</td>
											    </tr>
											  </table>
											</body>
											</html>
											';
											
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
								$headers .= 'To: Investor <'.$email.'>'."\r\n";
								$headers .= 'From: Bitcus <info@'.$_SERVER['SERVER_NAME'].'>'."\r\n";

								if(mail($email, 'Подтвердите Ваш E-mail на Bitcus', $message, $headers)){
									
									$error_echo = 'Спасибо за регистрацию!<br>Вам отправлено письмо для подтверждения E-mail.';
									$error_exit = 1;
								
								} else {
									
									$error_echo = 'Ошибка!<br>Обратитесь к администраторам.';
									$error_exit = 1;
							
								}
								
								/*header("HTTP/1.1 301 Moved Permanently");
								header("Location: http://".$_SERVER['SERVER_NAME']."/".$lang."/login/?act=1");
								exit();*/
			          			
							} else {
								$error_echo = 'Ошибка. Обратитесь к администраторам.';
			          			$error_exit = 1;
							}
							
						} else {
							
							$error_echo = 'Ошибка! Введите верно Ваш пароль.';
			          		$error_exit = 1;
						}
						
					}
					
				} else {
					
					$error_echo = 'Прочитайте/согласитесь с условиями регистрации';
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
      		
	      		<form name='registration_form' id='registration_form' action='' method="post">
	      			<input type="hidden" name='registration_form_hidden' value="1">
	      			<input type="hidden" name='parent' value="<?=$parent_ref?>">
	      			<?if($error_exit){
	      				echo "<p class='error_text'>".$error_echo."<a href='javascript:void(0);' class='close_error'></a></p>";
	      			}?>
	      			<table class='table_form'>
	      			<?if($parent_ref>0){?>
	      			<tr><td>Вас пригласил:</td><td><?=$parent_ref_email?></td></tr>
	      			<?}?>
	      			<tr><td>Email:</td><td><input type="email" name='email' value='<?=$email?>'></td></tr>
	      			<tr><td>Пароль:</td><td><input type="password" name='password'></td></tr>
	      			<tr><td>Пароль повторно:</td><td><input type="password" name='password2'></td></tr>
	      			</table>
	      			<br>
	      			<input type="checkbox" name='termsandconditions' id='termsandconditions' value='1'> - <label for='termsandconditions'>Я соглашаюсь с <a href='http://bitcus.net/<?=$lang?>/termsandconditions/' target="_blank">условиями</a></label>
	      			<br><br>
	      			<div class="g-recaptcha" data-sitekey="6LecqCkTAAAAAPXpRmLyFExi59mkv4PLJAtqsPxo"></div>
	      			
	      			<input type='submit' class='idei' value="Регистрация">
	      		</form>

			</div>
			
		</div>
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>