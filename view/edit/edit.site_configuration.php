<?php
  require_once(SYS_PATH."auth.php");

	$query = "SELECT * FROM pages WHERE id='$id'";
	$res = DB::query($query);
	$I = DB::fetchAssoc($res);
	$I['html_ru'] = unserialize($I['html_ru']);

$include='header'; include(EDIT_PATH."borders.admin.php");
?> 	

<form name=admingu ENCTYPE="multipart/form-data" METHOD=POST action="/_s/s_subm.php">
	<INPUT type=hidden name=id value=<?=$I['id']?>>
	<input type=hidden name=relocate value="<?=$relocate?>">

	<table cellspacing="0" cellpadding="0" border="0" class="table" >
   		<tr>
    		<td class="bigtit">Заголовок:</td>
    		<td><input class="bigtxt" name="name_<?=$lang?>_s" value="<?=htmlspecialchars($I['name_'.$lang])?>" disabled='disabled'></td>
   		</tr>
     	<tr>
    		<td>Адрес в строке браузера:</td>
    		<td>
    			<input class="smtxt" name="url_s" value="<?=$I['url']?>" onchange="document.forms.admingu.addr_s.value=''"  disabled='disabled'>
		   		<input type="hidden" name="addr_s" value="<?=$I['addr']?>" >
    		</td>
   		</tr>
   		
   		<tr>
    		<td>Количество новостей на внутренних справа:</td>
    		<td>
    			<input class="smsmtxt" name="html_ru_t[col_news]" value="<?=stripslashes(htmlspecialchars($I['html_ru']['col_news']))?>">
    		</td>
   		</tr>
   		<tr>
    		<td>Отображение банеров справа:</td>
    		<td>
    		  <input type='hidden' name="html_ru_t[show_banner]" value="0">
    			<input type='checkbox' name="html_ru_t[show_banner]" value="1" <?=(stripslashes(htmlspecialchars($I['html_ru']['show_banner']))?"checked='checked'":"")?> >
    		</td>
   		</tr>
   		<tr>
    		<td>Email для отправки с форм по умолчанию:</td>
    		<td>
    			<input class="smtxt" name="html_ru_t[email]" value="<?=stripslashes(htmlspecialchars($I['html_ru']['email']))?>">
    		</td>
   		</tr>
        <tr>
    		<td>Языковая версия по умолчанию:</td>
    		<td>
    			ru:<input type='radio' name="html_ru_t[default_lang]" value="ru" <?=($I['html_ru']['default_lang']=='ru'?"checked='checked'":"")?> />
                &nbsp; &nbsp; &nbsp; &nbsp;
                ua:<input type='radio' name="html_ru_t[default_lang]" value="ua" <?=($I['html_ru']['default_lang']=='ua'?"checked='checked'":"")?> />
                &nbsp; &nbsp; &nbsp; &nbsp;
                en:<input type='radio' name="html_ru_t[default_lang]" value="en" <?=($I['html_ru']['default_lang']=='en'?"checked='checked'":"")?> />
    		</td>
   		</tr>
	        </table>


<?php include(EDIT_PATH."inc.seo.php");

if($_SESSION['_auth_id']==1){?>
	<br><input type="submit" class="save" value="Сохранить">
<?}?>
</form>
<? $include='footer'; include(EDIT_PATH."borders.admin.php")?>