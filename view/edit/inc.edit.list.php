<?php
	require_once(SYS_PATH."auth.php");
	
	$query = "SELECT * FROM types ORDER BY pos";
	$res = DB::query($query);
    while($arr = DB::fetchAssoc($res)) $VAR['types'][$arr['id']] = $arr;
?>
<script type="text/javascript">ch=1</script>

<br>
<table cellspacing="0" cellpadding="0" class="list">
	<tr>
		<th>show</th>
		<th>позиция</th>
		<th>URL</th>
		<th>название</th>
		<th>&nbsp;</th>
		<th>Тип</th>
	</tr>
	<tr>
		<td><input class="enable_all" type="checkbox" value="1" name="enabl"></td>
		<td colspan="100">
	    	<a href="/_s/n_list_item.php?table=pages&amp;pos=1&amp;parent=<?=$I['id']?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)"><img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;" alt="Добавить" > Добавить в начало списка</a>
		</td>
	</tr>
	<? $list_i=0;
     $list_i2=0;
     $list_i3=0;
     $list_parts=0;
     $list_period=10;// сколько одновременно строк отображается на страничке
     $a_tr_show_per_line=10; // сколько "листалок/переключателей" в одной строчке
     $a_tr_show = '';
    $res=DB::query("SELECT * FROM pages WHERE parent='$id' ORDER BY pos");
    $list_coll=DB::numRows($res);

	  while($o=DB::fetchAssoc($res)){
    
    $list_i++;$list_i2++;$list_i3++;
	  
	  if($list_period==$list_i2){
	  
	   if($list_coll==$list_i) {$a_tr_show .= "<a href='#' onclick='return false;'' class='a_tr_show' rel='".($list_i-$list_i3+1)."' >".($list_i-$list_i3+1)."-$list_i</a>";
	   $tr_to_show_from = $list_i-$list_i3+1;
	   $list_parts++;
     } else {
     $list_parts++;
     $a_tr_show .= "<a href='#' onclick='return false;'' class='a_tr_show' rel='".($list_i-$list_i3+1)."' >".($list_i-$list_i3+1)."-$list_i</a> : ".(($list_parts%$a_tr_show_per_line)==0?'<br>':'')." ";
     }

	  $list_i2=0;$list_i3=0;
	  }

	  if($list_coll==$list_i && $list_i3!=0){
	  $list_parts++;
    $a_tr_show .= "<a href='#' onclick='return false;'' class='a_tr_show' rel='".($list_i-$list_i3+1)."' >".($list_i-$list_i3+1)."-$list_i</a>";
    $tr_to_show_from = $list_i-$list_i3+1;
    }
	?>

	<tr class='tr_hide' id='tr_to_show<?=$list_i?>' style='display:none;'>
		<td valign='middle'>
			<input type="hidden" name="enable_<?=$lang?>_s_<?=$o['id']?>" value="0" >
			<input type="checkbox" class="img" name="enable_<?=$lang?>_s_<?=$o['id']?>" value="1" <?=($o["enable_".$lang]?'checked="checked"':'')?>>
		</td>
		<td nowrap>
			<input name="position[<?=$o['id']?>]" value="<?=$o['pos']?>" class="small" onchange="ch=1">
			<input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/top.gif" title="вверх" onclick="move(<?=$o['id']?>,-11)">
			<input style="margin: 0 0 -7px;" type="image" class="img" src="/public/img/admin/bottom.gif" title="вниз" onclick="move(<?=$o['id']?>,+11)">
		</td>
		<td>
			<input name="url_s_<?=$o['id']?>" class="medium" value="<?echo htmlspecialchars($o['url'] ? $o['url'] : $o['id'])?>" onchange="ch=1;document.forms.admingu.addr_s_<?=$o['id']?>.value='';" onblur="val_<?=$o['id']?>=document.forms.admingu.url_s_<?=$o['id']?>.value;val2_<?=$o['id']?> = val_<?=$o['id']?>.toLowerCase();document.forms.admingu.url_s_<?=$o['id']?>.value=val2_<?=$o['id']?>;   ch=1;document.forms.admingu.addr_s_<?=$o['id']?>.value='';">
			<input name="addr_s_<?=$o['id']?>" type="hidden" value="<?echo htmlspecialchars($o['addr'])?>">
		</td>
		<td>
			<input name="name_<?=$lang?>_s_<?=$o['id']?>" class="big" value="<?echo htmlspecialchars($o["name_$lang"])?>" >
		</td>
		<td nowrap>
			<a href="/<?=$lang?>/edit/<?=$o['id']?>/?relocate=/<?=$lang?>/edit/<?=$o['id']?>/" onclick="return go(this.href)"><img style="margin: 0 0 -3px;" src="/public/img/admin/edit.gif" alt="редактировать" ></a>
			<a href="/_s/del.php?id=<?=$o['id']?>&amp;table=<?=$table?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return confirm('Удалить элемент? ВНИМАНИЕ!!! Удалятся все дочерние/вложеные элементы!') ? go(this.href) : false"><img style="margin: 0 0 -3px;" src="/public/img/admin/del.gif" alt="удалить"></a>
	    </td>
	    <td nowrap='nowrap'>
			<select class="select" name="type_s_<?=$o['id']?>" id="type_<?=$o['id']?>" onchange="ch=1;" <?if($o['type']) echo "disabled";?> >
			<? foreach($VAR['types'] as $key => $val) if (in_array($key, explode(',',$VAR['types'][$I['type']]['children']))) {?>
			     <option value="<?=$key?>" <?=$o['type']==$key ? 'selected' : ''?> <?if(!$o['type']) if($key==$VAR['types'][$I['type']]['child']) echo "selected";?>><?=$val['name']?></option>
			<? } ?>
			</select>

			<? if($o['type']) {?>
					<a href="#" id="type_enable_<?=$o['id']?>" onclick="document.getElementById('type_<?=$o['id']?>').disabled=false;document.getElementById('type_enable_<?=$o['id']?>').style.display='none';return false;"><img style="margin: 0 0 -3px;" src="/public/img/admin/block.gif" border="0" alt="Изменить тип шаблона страницы" class="cursor"></a>
			<? } ?>
	    </td>
	</tr>
<? } ?>
	
	
	<?if($list_coll>$list_period){?>
	<tr>
		<td>List:&nbsp;</td>
		<td colspan="100">
				<?=$a_tr_show?>
		</td>
	</tr>
	<?}?>
	
	
	<tr>
		<td>&nbsp;</td>
		<td colspan="100">
		<?if(in_array($I['type'],$_SESSION['_auth_r_types']) || $_SESSION['_auth_id']==1){?>
			<a href="/_s/n_list_item.php?table=<?=$table?>&amp;pos=999999&amp;parent=<?=$I['id']?>&amp;relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?>" onclick="return go(this.href)"><img src="/public/img/admin/doc-plus.gif" style="margin: 0 0 -2px;" alt='Добавить' > Добавить в конец списка</a>
		<?}?>
		</td>
	</tr>
</table>