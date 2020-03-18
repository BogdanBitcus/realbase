<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");


	function gnode($val) {?>
	 	<li>
		    <a href=/_s/type_item.php?id=<?=$val['id']?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?> >
		    	<b><?=$val['name']?></b> &nbsp; <img src="/public/img/admin/icon_edit.gif" alt="Свойства">
			</a>
			<a href=/_s/del.php?table=types&id=<?=$val['id']?>&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?> onclick="return confirm('Удалить?')">
				<img src="/public/img/admin/icon_del.gif" alt="Удалить">
			</a>
		</li>
	<?}
	
	function types($parent,$children){
		global $I;
		echo "<ul>";
		$query = "SELECT * FROM types WHERE id IN ($children) AND id!='$parent' LIMIT 100";
		$res = DB::query($query);
        while($arr = DB::fetchAssoc($res)) {
        	gnode($arr);
			if($arr['children']) types($arr['id'], $arr['children']);
		}
		echo "</ul>";
	}


	$include='header'; include(VIEW_PATH."borders.admin.php");?>

<a href=/_s/type_item.php?&relocate=<?echo urlencode($_SERVER['REQUEST_URI'])?> >Добавить</a>
<br />

<?	types(0,1);


	$include='footer'; include(VIEW_PATH."borders.admin.php");
?>