<?php
  require_once(SYS_PATH."auth.php");

	$query = "SELECT * FROM pages WHERE id='$id'";
	$res = DB::query($query);
	$I = DB::fetchAssoc($res);

$include='header'; include(VIEW_PATH."borders.admin.php");
?>

<form name='admingu' ENCTYPE="multipart/form-data" METHOD=POST action="/_s/s_subm.php">
<INPUT type='hidden' name='id' value=<?=$I['id']?>>
<input type='hidden' name='relocate' value="<?=$relocate?>">

	<table cellspacing="0" cellpadding="0" border="0" class="table" width="100%">
   		<tr>
    		<td class="bigtit">Заголовок:</td>
    		<td><input class="bigtxt" name="name_<?=$lang?>_s" value="<?=htmlspecialchars($I['name_'.$lang])?>"></td>
   		</tr>
     	<tr>
    		<td>Адрес в строке браузера:</td>
    		<td>
    			<input class="smtxt" name="url_s" value="<?=$I['url']?>" onchange="document.forms.admingu.addr_s.value=''">
		   		<input type="hidden" name="addr_s" value="<?=$I['addr']?>" >
    		</td>
   		</tr>
   		<tr>
          	<td class="bigtit">Количество голосов:</td>
    		<td><input class="bigtxt" name="html_<?=$lang?>_s" value="<?=htmlspecialchars($I['html_'.$lang])?>"></td>
	    </tr>
	</table>

<?php include(VIEW_PATH."inc.seo.php");

if($_SESSION['_auth_id']){?>
	<br><input type="submit" class="save" value="Сохранить">
<?}?>
</form>
<? $include='footer'; include(VIEW_PATH."borders.admin.php")?>