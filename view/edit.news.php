<?php
  require_once(SYS_PATH."auth.php");

	$query = "SELECT * FROM pages WHERE id='$id'";
	$res = DB::query($query);
	$I = DB::fetchAssoc($res);

$include='header'; include(VIEW_PATH."borders.admin.php");
?>

<form name='admingu' id='admingu' ENCTYPE="multipart/form-data" METHOD='POST' action="/_s/s_subm.php">
<INPUT type='hidden' name='id' value='<?=$I['id']?>'>
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
    		<td>Дата</td>
    		<td>
      			<input name="date_s" id="date_s" class="smsmtxt" value="<?=($I['date'] != "0000-00-00" ? $I['date'] : date('Y-m-d'))?>">
    		</td>
   		</tr>
   		<tr>
          	<td>Картинка:<br><span class="sm">Размер: 126px * 99px</span></td>
          	<td nowrap>
				<input name="img_s" id="img_s" class="smtxt" value="<?=$I['img']?>">
				<br>
				<div style="padding: 5px 0 0; text-align: left;<?=(($I['img'] != '')?(''):('display: none;'))?>" id="prev_div_img_s">
					<img id="prev_img_s" src="<?=$I['img']?>" alt='preview' >
				</div>
          	</td>
   		</tr>
   		<tr>
          	<td>Анонс:</td>
          	<td>
             	<textarea name="short_<?=$lang?>_s" class="smarea" cols='50' rows='10' ><?=htmlspecialchars($I[short_.$lang])?></textarea>
          	</td>
    	</tr>
   	<tr>
          <td colspan="2">
          		<textarea id="html_<?=$lang?>_h" name="html_<?=$lang?>_h" style="width: 100%; height: 350px;" class="tinymce" cols='50' rows='10' ><?=stripslashes($I[html_.$lang])?></textarea>
          </td>
        </tr>
        </table>
        
<?php include(VIEW_PATH."inc.seo.php");

if($_SESSION['_auth_id']==1){?>
	<br><input type="submit" class="save" value="Сохранить">
<?}?>
</form>
<? $include='footer'; include(VIEW_PATH."borders.admin.php")?>
