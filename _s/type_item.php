<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
	
	
	$relocate = htmlspecialchars($_REQUEST['relocate']);
	$id = (int) $_REQUEST['id'];
	$table = 'types';
	
	
	if ($id) {
	    $query = "SELECT * FROM $table WHERE id='$id'";
	    $res = DB::query($query);
	    $I = DB::fetchAssoc($res);
	}
	
	$query = "SELECT * FROM types ORDER BY pos";
	$res = DB::query($query);
    while($arr = DB::fetchAssoc($res)) $VAR['types'][$arr['id']] = $arr;
	

	$include='header'; include(VIEW_PATH."borders.admin.php")?>

<FORM action="/_s/s_subm.php" method=post enctype="multipart/form-data">
	<input type=hidden name=relocate value="<?=$relocate?>">
	<input type=hidden name=id value="<?=$id?>">
	<input type=hidden name=table value=<?=$table?>>
	<fieldset>
		<legend>Параметры</legend>
		Название: <input name='name_s' value="<?=$I['name']?>">
		<br><br>
		Возможные типы для страниц внутри этой.<br><br>
		   <?
		   if (is_array($VAR['types']))
		   foreach ($VAR['types'] as $key => $val)
		   if ($key != 1) { ?>
		       <input type='checkbox' class='chk' name='children_a[]' value=<?=$key?> <?=(in_array($key, explode(',',$I['children'])) ?'checked':'')?>>
		       <b><?=$val['name']?> </b>
		       <input type='radio' class='chk' name='child_s' value=<?=$key?> <?=($I['child']==$key ?'checked':'')?> >
		       <br>
		   <? } ?>
		<br>
<?
	 $dir_files = scandir(VIEW_PATH);
	 foreach($dir_files as $f){
	 	if (preg_match("/^edit.*/",$f)){
	 		$selected = '';
	 		if($I['admin'] == $f){
				$selected = "selected='selected'";
			}
	 		$admin_s .= "<option value='".$f."' ".$selected.">".$f."</option>";
	 	} else if (preg_match("/^view.*/",$f)){
			$selected = '';
	 		if($I['tpl'] == $f){
				$selected = "selected='selected'";
			}
	 		$tpl_s .= "<option value='".$f."' ".$selected.">".$f."</option>";
		}
	 }
 ?>
		Шаблон для редактирования:
		<select name='admin_s'>
			<option value=''>-</option>
			<?=$admin_s?>
		</select>
		<!--<input name='admin_s' value="<?=$I['admin']?>">-->
		<br><br>
		Шаблон для показа на сайте:
		<select name='tpl_s'>
			<option value=''>-</option>
			<?=$tpl_s?>
		</select>
		<!--<input name='tpl_s' value="<?=$I['tpl']?>">-->
	</fieldset>
	<br>
	<input type=submit value='Сохранить'>
</form>

<? $include='footer'; include(VIEW_PATH."borders.admin.php")?>