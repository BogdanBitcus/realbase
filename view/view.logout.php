<?php 

	
	unset($_SESSION['id_user']);
	unset($_SESSION['email']);
	unset($_SESSION['name']);
	unset($_SESSION['wallet']);
	unset($_SESSION['phone']);
	unset($_SESSION['sign_user']);
	
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['SERVER_NAME']."/");
	exit();
	
			
$include = 'header'; include(VIEW_PATH."borders.index.php"); ?>

	<div class='obmen'>
		<div class='divcenter clear'>
			<div class='form' style='padding:10px 40px;'>
				
			<h1><?=$I['name_'.$lang]?></h1>
      		<?=$I['html_'.$lang]?>
      		
			</div>
			
		</div>
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>