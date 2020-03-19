<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	require_once(SYS_PATH."auth.php");
  
	$table = "admins";
	$id = (int) $_REQUEST['id_user'];
	$relocate = htmlspecialchars($_REQUEST['relocate']);

	$query = "SELECT * FROM $table WHERE id='$id'";
 	$I = DB::fetchAssoc(DB::query($query));

$include='header'; include(EDIT_PATH."borders.admin.php")?>

<form name=admingu ENCTYPE="multipart/form-data" METHOD=POST action="/_s/s_subm.php">
<INPUT type=hidden name=id value=<?=$I[id]?>>
<INPUT type=hidden name=table value=<?=$table?> >
<input type=hidden name=relocate value="<?=$relocate?>">


	<table cellspacing="0" cellpadding="0" border="0" class="table">
   		<tr>
    		<td>ФИО:</td>
    		<td><input class="smtxt" name="fio_s" value="<?=htmlspecialchars($I['fio'])?>"></td>
   		</tr>
   		<input type="hidden" class="smtxt" name="url_s" value="<?=$I['url']?>" onchange="document.forms.admingu.addr_s.value=''">
		  <input type="hidden" name="addr_s" value="<?=$I['addr']?>" >
   		<tr>
    		<td>Логин:</td>
    		<td>
    			<input class="smtxt" name="log_s" value="<?=$I['log']?>">
    		</td>
   		</tr>
   		<tr>
    		<td>Пароль:</td>
    		<td>
    			<input class="smtxt" name="pass_s" value="<?=$I['pass']?>">
    		</td>
   		</tr>
   		<tr>
    		<td>Email:</td>
    		<td>
    			<input class="smtxt" name="email_s" value="<?=$I['email']?>">
    		</td>
   		</tr>
   		<tr>
    		<td>Права на редактирование разделов:</td>
    		<td>
    			<input class="smtxt" name="r_types_s" id="r_types_s" value="<?=$I['r_types']?>"> 
    			<? $I_r_types = explode(',',$I['r_types']); ?>
    		</td>
   		</tr>
	        </table>
	
        <br><input type="submit" class="save" name="Submit3" value="Сохранить">
</form>


<script type='text/javascript'>
$(document).ready(function(){

  $('.razd_types').live('click',function(){
  r_types_s_text = '';
  i=0;
  $('input:checkbox[name="razd_types_[]"]:checked').each(function(index) {
  i++;
   if(i>1)
   r_types_s_text += "," + $(this).val();
   else
   r_types_s_text += $(this).val();
  }); 
   $('#r_types_s').val(r_types_s_text);
  });

});
</script>

<? $include='footer'; include(EDIT_PATH."borders.admin.php")?>
