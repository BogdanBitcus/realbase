<?
	require_once(SYS_PATH."auth.php");
  
	$query = "SELECT * FROM pages WHERE parent='$id' ORDER BY pos";
	$res = DB::query($query);
 	while($o = DB::fetchAssoc($res)) $I[row][]=$o;


	$include='header'; include(VIEW_PATH."borders.admin.php");
?>

<form name="admingu" action="/_s/s_list.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="relocate" value="<?=$_SERVER['REQUEST_URI']?>">
	<input type="hidden" name="table" value="pages">
	<input type="hidden" name="id" value="<?=$I['id']?>">
	<input type="hidden" name="lang" value="<?=$lang?>">
	
	Страничка:<br />
	<input name="name_<?=$lang?>_s" value="<?=htmlspecialchars($I['name_'.$lang])?>" class="bigtxt">

<?
		include(VIEW_PATH."inc.edit.infoblock.php");
		include(VIEW_PATH."inc.edit.list.php");

	   if($_SESSION['last_tr_to_show_from']==1){
	    $tr_to_show_from2 = $tr_to_show_from;
	    unset($_SESSION['last_tr_to_show_from']);
	   } else {
	    $tr_to_show_from2=1;
	   }


	if($_SESSION['_auth_id']){?>
		<br><input type="submit" class="save" value="Сохранить">
	<?}?>
</form>

<script type='text/javascript'>
$(window).load(function(){
	$('.tr_hide').hide();
	$('.a_tr_show').removeClass('list_here');
	$('.a_tr_show').slice(<?=($tr_to_show_from2==1?'0':$list_parts-1)?>, <?=($tr_to_show_from2==1?'1':$list_parts)?>).addClass('list_here');
	for(i=<?=$tr_to_show_from2?>;i<<?=$tr_to_show_from2+$list_period?>;i++){
		if ($('#tr_to_show'+i).length){$('#tr_to_show'+i).show();}
	}
	
	
	$('.a_tr_show').click(function(){
	    $('.tr_hide').hide();
	    var tr_to_show = parseInt($(this).attr('rel'));
	    $('.a_tr_show').removeClass('list_here');
	    $(this).addClass('list_here');
	    var max_i = tr_to_show+<?=$list_period?>;
	    for(i=tr_to_show;i<max_i;i++){
	      if ($('#tr_to_show'+i).length){$('#tr_to_show'+i).show();}
	    }
  	});
});
</script>

<? $include='footer'; include(VIEW_PATH."borders.admin.php"); ?>