<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	
	$table = 'admins';
	$query = "SELECT * FROM ".$table."";// WHERE parent='1' ORDER BY pos";
	$res = DB::query($query);
 	while($o = DB::fetchAssoc($res)) $I['row'][]=$o;

	$include='header'; include(EDIT_PATH."borders.admin.php");

?>
<form name="admingu" action="/_s/s_list.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="relocate" value="<?=$_SERVER['REQUEST_URI']?>">
<input type="hidden" name="table" value="<?=$table?>">
<input type="hidden" name="id" value="1<?//=$I[id]?>">
<input type="hidden" name="lang" value="<?=$lang?>">
<script type="text/javascript">ch=1</script>
<br><br>
<table cellspacing="0" cellpadding="0" class="list">
	<tr>
		<th>show</th>
		<th>позиция</th>
		<th>URL</th>
		<th>ФИО</th>
		<th>Login</th>
		<th>Password</th>
		<th>Email</th>
		<th>&nbsp;</th>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
<?
	$res=DB::query("SELECT * FROM $table");
	while($o=DB::fetchAssoc($res)){
?>
	<tr>
		<td valign='middle'>
			<input type="hidden" name="enable_s_<?=$o['id']?>" value="0">
			<input type="checkbox" class="img" name="enable_s_<?=$o['id']?>" value="1" <?=($o["enable"]?'checked':'')?>>
		</td>
		<td nowrap>
			<input name="position[<?=$o['id']?>]" value="<?=$o['pos']?>" class="small" onchange="ch=1">
			<input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/top.gif" title="вверх" onclick="move(<?=$o['id']?>,-11)"><input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/bottom.gif" title="вниз" onclick="move(<?=$o['id']?>,+11)">
		</td>
		<td>
			<input name="url_s_<?=$o['id']?>" class="small" value="<?echo htmlspecialchars($o['url'] ? $o['url'] : $o['id'])?>" onchange="ch=1;document.forms.admingu.addr_s_<?=$o[id]?>.value='';" onblur="val_<?=$o[id]?>=document.forms.admingu.url_s_<?=$o['id']?>.value;val2_<?=$o['id']?> = val_<?=$o['id']?>.toLowerCase();document.forms.admingu.url_s_<?=$o[id]?>.value=val2_<?=$o[id]?>;   ch=1;document.forms.admingu.addr_s_<?=$o[id]?>.value='';">
			<input name="addr_s_<?=$o['id']?>" type="hidden" value="<?echo htmlspecialchars($o['addr'])?>">
		</td>
		<td>
			<input name="fio_s_<?=$o['id']?>" class="big" value="<?echo htmlspecialchars($o["fio"])?>" readonly='readonly' >
		</td>
		<td>
			<input name="log_s_<?=$o['id']?>" class="medium" value="<?echo htmlspecialchars($o["log"])?>"  readonly='readonly' >
		</td>
		<td>
			<input name="pass_s_<?=$o['id']?>" class="medium" type='password' value="<?echo htmlspecialchars($o["pass"])?>"  readonly='readonly' >
		</td>
		<td>
			<input name="email_s_<?=$o['id']?>" class="big" value="<?echo htmlspecialchars($o["email"])?>"  readonly='readonly' >
		</td>
		<td nowrap>
			<a href="/_s/l_adm_r.php?id_user=<?=$o['id']?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)"><img style="margin: 0 0 -3px;" src="/public/img/admin/edit.gif" alt="редактировать" ></a>
			<?if($o['id']!=1){?>
			<a href="/_s/del.php?id=<?=$o['id']?>&amp;table=<?=$table?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return confirm('Удалить пользователя?') ? go(this.href) : false"><img style="margin: 0 0 -3px;" src="/public/img/admin/del.gif" alt="удалить"></a>
	    <?}?>  </td>
		  <input type='hidden' name='type_s_<?=$o['id']?>' value="2">
	</tr>

	<? } ?>
	<tr>
		<td>&nbsp;</td>
		<td colspan="100">
			<a href="/_s/n_list_item.php?table=<?=$table?>&amp;pos=999999&amp;parent=<?=$I['id']?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)"><img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;" alt='Добавить' > Добавить</a>
		</td>
	</tr>
</table>



<br>
<input type="submit" class="save" value="Сохранить">
</form>

<? $include='footer'; include(EDIT_PATH."borders.admin.php")?>
