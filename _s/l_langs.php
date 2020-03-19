<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	
	$include='header'; include(EDIT_PATH."borders.admin.php");
	$table = 'langs';

?>
<form name="admingu" action="/_s/s_list.php" method="post" enctype="multipart/form-data">

	<input type="hidden" name="relocate" value="<?=$_SERVER['REQUEST_URI']?>">
	<input type="hidden" name="table" value="<?=$table?>">
	<input type="hidden" name="lang" value="<?=$lang?>">
	<br>
	<a href="/_s/n_list_item.php?table=<?=$table?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)">
		<img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;" alt='Добавить' > Добавить запись
	</a>
	<br><br>
	<table cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th>position</th>
			<th>alias</th>
			<th>ru</th>
			<th>ua</th>
			<th>en</th>
	        <th>&nbsp;</th>
		</tr>
	<?  $query = "SELECT * FROM ".$table." ORDER BY id";
		$res = DB::query($query);
	while($o = DB::fetchAssoc($res)){?>
	    <tr>
	    	<td><input name="position[<?=$o['id']?>]" class="small" value="<?=($o["pos"]?$o["pos"]:'1')?>" onchange="ch=1" /></td>
			<td><input name="alias_s_<?=$o['id']?>" value="<?=($o["alias"]?htmlspecialchars($o["alias"]):$o["id"])?>" /></td>
	        <td><textarea id="ru_h_<?=$o['id']?>" name="ru_h_<?=$o['id']?>" ><?=stripslashes($o['ru'])?></textarea></td>
	        <td><textarea id="ua_h_<?=$o['id']?>" name="ua_h_<?=$o['id']?>" ><?=stripslashes($o['ua'])?></textarea></td>
	        <td><textarea id="en_h_<?=$o['id']?>" name="en_h_<?=$o['id']?>" ><?=stripslashes($o['en'])?></textarea></td>
			<td nowrap>
				<a href="/_s/del.php?id=<?=$o['id']?>&amp;table=<?=$table?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return confirm('Удалить элемент?') ? go(this.href) : false">
				<img style="margin: 0 0 -3px;" src="/public/img/admin/del.gif" alt="удалить" /></a>
	        </td>
		</tr>
	<?}?>
	</table>

	<br /><input type="submit" class="save" value="Сохранить" />
</form>

<? $include='footer'; include(EDIT_PATH."borders.admin.php") ?>
