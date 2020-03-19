<?php
	require_once(SYS_PATH."auth.php");
?>
<div style="padding: 10px 0;">
	<div id="infoblock_a" class="display" onclick="showblock('infoblock');">Редактировать текстовую часть</div>
	<div id="seoblock_a" class="display" onclick="showblock('seoblock');">Редактировать SEO-блок</div>
	<div class="clear"></div>
</div>
<div id="infoblock" style="display:none;">
	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
		<tr>
    		<td>
				<textarea cols='50' rows='5' id="html_<?=$lang?>_s" name="html_<?=$lang?>_s"><?=$I['html_'.$lang]?></textarea>
    		</td>
    	</tr>
	</table>
</div>
<div id="seoblock" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="0" class="table">
		<tr>
    		<td>Title:</td>
    		<td><input name="title_<?=$lang?>_s" value="<?=htmlspecialchars($I['title_'.$lang])?>" class="smtxt"></td>
   		</tr>
   		<tr>
			<td>Описание:</td>
			<td><textarea cols='50' rows='5' name="des_<?=$lang?>_s"><?=htmlspecialchars($I['des_'.$lang])?></textarea></td>
		</tr>
		<tr>
			<td>Ключевые&nbsp;слова:</td>
			<td><textarea cols='50' rows='5' name="key_<?=$lang?>_s"><?=htmlspecialchars($I['key_'.$lang])?></textarea></td>
    	</tr>
	</table>
</div>