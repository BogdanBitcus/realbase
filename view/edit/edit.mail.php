<?php
  require_once(SYS_PATH."auth.php");

	$query = "SELECT * FROM pages WHERE id='$id'";
	$res = DB::query($query);
	$I = DB::fetchAssoc($res);

$include='header'; include(EDIT_PATH."borders.admin.php");
?>
<form name=admingu ENCTYPE="multipart/form-data" METHOD=POST action="/_s/s_subm.php">
<INPUT type=hidden name=id value=<?=$I[id]?>>
<input type=hidden name=relocate value="<?=$relocate?>">


	<table cellspacing="0" cellpadding="0" border="0" class="table" width="100%">
   		<tr>
    		<td class="bigtit">Ǡ㮫꺼/td>
    		<td><input class="bigtxt" name="name_<?=$lang?>_s" value="<?=htmlspecialchars($I['name_'.$lang])?>"></td>
   		</tr>
     	<tr>
    		<td>$�屠⠱�� ᰠ�祰ຼ/td>
    		<td>
    			<input class="smtxt" name="url_s" value="<?=$I['url']?>" onchange="document.forms.admingu.addr_s.value=''">
		   		<input type="hidden" name="addr_s" value="<?=$I['addr']?>" >
    		</td>
   		</tr>
   		<tr>
          	<td colspan="2">
          		<textarea id="html_<?=$lang?>_h" name="html_<?=$lang?>_h" style="width: 100%; height: 350px;"><?=stripslashes($I['html_'.$lang])?></textarea>
          	</td>
	        </tr>
	        </table>

<?php include(EDIT_PATH."inc.seo.php");

if($_SESSION['_auth_id']==1){?>

    <input type="submit" class="save" name="Submit3" value="Ѯ��୨��">
	<input type="button" class='save' name="S" id='send_emails' value="...蠮�ﰠ⨲� ⠰౱�몳">
              
<script type='text/javascript'>
$(document).ready(function(){

  $('#send_emails').click(function(){
      //alert('ҥ��頰妨졧); return false;
      sendletter();
  });

});
function sendletter() {
  window.open('/tpl/mail_ajax.php?id=<?=$I[id]?>&lang=<?=$lang?>', 'url', 'scrollbars=yes, status=yes, resizable=yes, width=600, height=400, top=200, left=200').focus();
  return false;
}
</script>             	
        
<?}?>
</form>
<? $include='footer'; include(EDIT_PATH."borders.admin.php")?>
