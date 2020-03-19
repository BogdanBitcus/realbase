<?php
	require_once(SYS_PATH."auth.php");
?>

<script type="text/javascript">
	function show_seo(){
		document.getElementById("polya_div_seo_").style.display = "block";
		document.getElementById("link_div_seo_").style.display = "none";
	}
</script>

<div id='link_div_seo_'>
<table align="center" cellpadding='5' width='100%'  style='border:1px solid #bfbfbf;'>
	<tr>
		<td><a href='#' onclick='show_seo(); return false;'>Данные SEO</a></td>
	</tr>
</table>
</div>
<div id='polya_div_seo_' style='display:none;'>
	<table align="center" cellpadding='5' width='100%'  style='border:1px solid #bfbfbf;'>
   		<tr>
    		<td>Title:</td>
    		<td><input class="smtxt" name=title_<?=$lang?>_s value="<?=htmlspecialchars($I['title_'.$lang])?>"></td>
   		</tr>
   		<tr>
	        <td>Описание:</td>
        	<td>
            	<textarea name="des_<?=$lang?>_s" class="smarea"><?=htmlspecialchars($I['des_'.$lang])?></textarea>
        	</td>
	   	</tr>
   		<tr>
			<td>Ключевые&nbsp;слова:</td>
          	<td>
            	<textarea name="key_<?=$lang?>_s" class="smarea"><?=htmlspecialchars($I['key_'.$lang])?></textarea>
          	</td>
	    </tr>
	</table>
</div>