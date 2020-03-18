<?php

	$error_exit = 0;
	$secretKey = "6Lf_9QcUAAAAAMbf4tPbEn3RhVTjAokstwyODSKn";
    $ip = $_SERVER['REMOTE_ADDR'];
    $email = htmlspecialchars($_REQUEST['email']);
	
    
    if(isset($_POST['g-recaptcha-response']) || isset($_REQUEST['recovery_form_hidden']) || $_REQUEST['recovery_form_hidden']==1){
    	
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
	        	
	        	$query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
		        $res = DB::query($query);
		        if(DB::numRows($res)>0){
		        	
		        	$new_pass = generate_pass(8);
					
					$query = "UPDATE users SET
						password = '".sign($new_pass)."'
						WHERE email = '".$email."'
						LIMIT 1
					";
					if(DB::exec($query)){
						
						$message = '<html>
									<head>
									  <title>Recovery password</title>
									</head>
									<body>
									  <table>
									    <tr>
									      <td>Здравствуйте,<br> 
									      Ваш новый пароль: '.$new_pass.'<br> 
									      На более удобный можете заменить в Вашем личном кабинете.
									      </td>
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
						if(mail($email, 'Восстановление пароля на Bitcus', $message, $headers)){
							
							$error_echo = 'Вам отправлено письмо с новым паролем.';
							$error_exit = 1;
							
						} else {
							
							$error_echo = 'Ошибка!<br>Обратитесь к администраторам.';
							$error_exit = 1;
							
						}
	          			
					} else {
						
						$error_echo = 'Ошибка. Обратитесь к администраторам.';
	          			$error_exit = 1;
	          			
					}
						
	          		
				} else {
					
					$error_echo = 'Пользователь с таким email не найдено. Повторите попытку.';
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
      		
	      		<form name='registration_form' id='recovery_form' action='' method="post">
	      			<input type="hidden" name='recovery_form_hidden' value="1">
	      			<?if($error_exit){
	      				echo "<p class='error_text'>".$error_echo."<a href='javascript:void(0);' class='close_error'></a></p>";
	      			}?>
	      			<table class='table_form'>
	      			<tr><td>Email:</td><td><input type="email" name='email' value='<?=$email?>'></td></tr>
	      			</table>
	      			<div class="g-recaptcha" data-sitekey="6Lf_9QcUAAAAAPyUV9s7DDklhHeYhSq6vsEfemKH"></div>
	      			
	      			<input type='submit' class='idei' value="Напомнить">
	      		</form>

			</div>
			
		</div>
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>