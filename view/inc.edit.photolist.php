<script>ch=1</script>
<?
	$res = DB::query("SELECT * FROM pages WHERE parent='$id' ORDER BY pos");
    $array_childs = array();
	while($o = DB::fetchAssoc($res)) $array_childs[] = $o;
?>
<br><br>
<table cellspacing="0" cellpadding="0" class="list">
	<tr>
		<th>show</th>
		<th>позиция</th>
		<th>первью</th>
		<th>&nbsp;</th>
		<th>название</th>
		<th>&nbsp;</th>
		<th>Тип</th>
	</tr>
	<tr>
		<td align=middle><input class="enable_all" type="checkbox" value="1" name="enabl"></td>
		<td colspan="100">
		<?if(in_array($o['type'],$_SESSION['_auth_r_types']) || $_SESSION['_auth_id']==1){?>
	    	<a href="/clone.php?table=pages&pos=1&parent=<?=$I['id']?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)">
	    	<img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;">
	    	Добавить в начало списка
	    	</a>
	  <?}?>
		</td>
	</tr>
<?
if(count($array_childs) > 0 ) foreach($array_childs as $o) {
?>
	<tr>
		<td align=middle>
			<input type="hidden" name="enable_<?=$lang?>_s_<?=$o['id']?>" value="0">
			<input type="checkbox" class="img" name="enable_<?=$lang?>_s_<?=$o['id']?>" value="1" <?=($o["enable_".$lang]?'checked':'')?>>
		</td>
		<td nowrap>
			<input name="position[<?=$o['id']?>]" value="<?=$o['pos']?>" class="small" onchange="ch=1">
			<input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/top.gif" title="вверх" onclick="move(<?=$o[id]?>,-11)"><input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/bottom.gif" title="вниз" onclick="move(<?=$o['id']?>,+11)">
			<input name="url_s_<?=$o['id']?>" type="hidden" value="<?echo htmlspecialchars($o['url'] ? $o['url'] : $o['id'])?>" onchange="ch=1;document.forms.admingu.addr_s_<?=$o['id']?>.value='';">
			<input name="addr_s_<?=$o['id']?>" type="hidden" value="<?echo htmlspecialchars($o['addr'])?>">
		</td>
		<td>
<? $path_parts = array(); $path_parts = pathinfo($o['img']); ?>
			<div class="previmg" style="<?=(($o['img'] != '')?(''):('display: none;'))?>" id="prev_div_img_s_<?=$o['id']?>">
				<img id="prev_img_s_<?=$o['id']?>" src="<?=(($o['img']) ? ($path_parts['dirname'].'/_thumbs/_'.$path_parts['basename']) : (''))?>">
			</div>
		</td>
		<td>
			<input name="img_s_<?=$o['id']?>" id="img_s_<?=$o['id']?>" type="hidden" value="<?=$o['img']?>">
			<input type="button" onclick="browseImage('img_s_<?=$o['id']?>')" value="Обзор" title="Вставить картинку" class="ins">
		</td>
		<td>
			<input name="name_<?=$lang?>_s_<?=$o['id']?>" class="medium" value="<?echo htmlspecialchars($o["name_$lang"])?>" >
		</td>
		<td nowrap>
			<?if(in_array($o['type'],$_SESSION['_auth_r_types']) || $_SESSION['_auth_id']==1){?>
			<a href="/delete.php?id=<?=$o['id']?>&table=<?=$table?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return confirm('Удалить?') ? go(this.href) : false"><img style="margin: 0 0 -3px;" src=/public/img/admin/del.gif alt="удалить"></a>
			<?}?>
		</td>
		<td nowrap>
		<select class="select" name="type_s_<?=$o['id']?>" id="type_<?=$o['id']?>" onchange="ch=1;" <?if($o['type']) echo "disabled";?> >
		<? foreach($VAR['types'] as $key => $val) if (in_array($key, split(',',$VAR['types'][$I['type']]['children']))) { ?>
		     <option value="<?=$key?>" <?=$o['type']==$key ? 'selected' : ''?> <?if(!$o['type']) if($key==$VAR['types'][$I['type']]['child']) echo "selected";?>><?=$val['name']?></option>
		<? } ?>
        
		</select>
<? if($o['type']) { ?>
		<a href="#" id="type_enable_<?=$o['id']?>" onclick="document.getElementById('type_<?=$o['id']?>').disabled=false;document.getElementById('type_enable_<?=$o[id]?>').style.display='none';return false;"><img style="margin: 0 0 -3px;" src="/public/img/admin/block.gif" border="0" alt="Изменить тип шаблона страницы" class="cursor"></a>
<? } ?>
		</td>
	</tr>
<?}?>
	<tr>
		<td>&nbsp;</td>
		<td colspan="100">
		<?if(in_array($o['type'],$_SESSION['_auth_r_types']) || $_SESSION['_auth_id']==1){?>
		<a href="/clone.php?table=<?=$table?>&pos=999999&parent=<?=$I['id']?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)"><img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;"> Добавить в конец списка</a>
		<?}?>
		</td>
	</tr>
</table>