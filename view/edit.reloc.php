<?php
  require_once(SYS_PATH."auth.php");

	$query = "SELECT * FROM pages WHERE id='$id'";
	$res = DB::query($query);
	$I = DB::fetchAssoc($res);

$include='header'; include(VIEW_PATH."borders.admin.php");
?>

<form name=admingu ENCTYPE="multipart/form-data" METHOD=POST action="/_s/s_subm.php">
<INPUT type=hidden name=id value=<?=$I['id']?>>
<input type=hidden name=relocate value="<?=$relocate?>">


<table align="center" cellpadding=5 width=100%  style='border:1px solid #bfbfbf;'>
   <tr>
   <th colspan=2 align=left  style='border:1px solid #bfbfbf;'><img src='/img/admin/icon_edit.gif' hspace=5><?=$I['type']?>: <?=$lang?></th>
   </tr>
   <tr>
    <td class=key>Заголовок</td>
    <td class=val> <INPUT class=txt name=name_<?=$lang?>_s value="<?=htmlspecialchars($I['name_'.$lang])?>"> </td>
   </tr>
     <tr>
    <td class=key>Адрес в строке браузера</td>
    <td class=val>
    	<INPUT class=char name=url_s value="<?=$I['url']?>" onchange="document.forms.admingu.addr_s.value=''"> 
		<INPUT type=hidden name=addr_s value="<?=$I['addr']?>" >    
    </td>
   </tr>
   <tr>
    <td class=key>Ссылка: (<b>Внешняя через http://</b>):</td>
    <td class=val>
    	<INPUT class=txt name=short_<?=$lang?>_s value="<?=htmlspecialchars($I["short_".$lang])?>">
    </td>
   </tr>
</table>

<?php include(VIEW_PATH."inc.seo.php");

if($_SESSION['_auth_id']==1){?>
<br><input type="submit" class="save" value="Сохранить">
<?}?>
</form>
<? $include='footer'; include(VIEW_PATH."borders.admin.php")?>
