<?php
  require_once(SYS_PATH."auth.php");


	$table = 'pages';
	$query = "SELECT * FROM ".$table." WHERE parent='$id' ORDER BY pos";
	$res = DB::query($query);
 	while($o = DB::fetchAssoc($res)) $I[row][]=$o;

	$include='header'; include(VIEW_PATH."borders.admin.php");
?>

<form name="admingu" action="/_s/s_list.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="relocate" value="<?=$_SERVER['REQUEST_URI']?>">
<input type="hidden" name="table" value="<?=$table?>">
<input type="hidden" name="id" value="<?=$I['id']?>">
<input type="hidden" name="lan" value="<?=$lang?>">
Заголовок страницы:<br />
<input name="name_<?=$lang?>_s" value="<?=htmlspecialchars($I['name_'.$lang])?>" class="bigtxt">
<?  include(VIEW_PATH."inc.edit.infoblock.php");
	include(VIEW_PATH."inc.edit.photolist.php");
?>
<script type='text/javascript'>
$(document).ready(function(){

// checkAll begin

 $('.enable_all').click(function(){
  if ($(this).is(":checked")){
    $("input[type='checkbox'].img").attr("checked","checked");
  } else {
    $("input[type='checkbox'].img").removeAttr("checked");
  }
  });
  
  $("input[type='checkbox'].img").click(function(){
    $(".enable_all").removeAttr("checked");
  });

// checkAll and

});
</script>
<?if(in_array($I['type'],$_SESSION['_auth_r_types']) || $_SESSION['_auth_id']==1){?>
<br>
<input type="submit" class="save" value="Сохранить">
<?}?>
</form>

<? $include='footer'; include(VIEW_PATH."borders.admin.php")?>
