<?php $include = 'header'; include(VIEW_PATH."borders.index.php"); ?>

	<div class='obmen'>
		<div class='divcenter clear'>
			<div class='form' style='padding:10px 40px;'>
				
			<h1><?=$I['name_'.$lang]?></h1>
      		<?=stripslashes($I['html_'.$lang])?>

			</div>
			
		</div>
	</div>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>