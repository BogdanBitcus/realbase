<?  
	require_once(SYS_PATH."auth.php");

	if($include == 'header' ) {
		
?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CMS - <?=$I['name_'.$lang]?></title>
	<link rel="stylesheet" href="/public/css/styles_cms.css">
	<script type="text/javascript" src="/public/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="/public/js/scriptadm.js"></script>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
</head>
<body data-template="<?=$I['type']?>" data-lang="<?=$lang?>" class="" data-domen='<?=$_SERVER['HTTP_HOST']?>'>
<table style='width:100%;height:100%;' cellspacing="0" cellpadding="0">
<tr>
  <td colspan='2' style='height:50px;'>
	<div id="header">
		<div id="lh">
			<img src="/public/img/admin/login_cms/clientlogo.png" style="float: left;" alt='ClientLogo'>
			<div class="tt">Система администрирования</div>
		</div>
		<div id="rh" style='padding:0px;'>
		 <div style='text-align:right;padding:0px 0px 0px 0px;'>Вы вошли как: <b><?=$_SESSION['_auth_fio']?></b></div>
			<a href="/<?=$lang?>/<?=$I['addr']?>" target="_blank" class="site">Публичная часть</a>
			<a href="/logout" class="exit">Выход</a>
		</div>
		<div class="clear"></div>
	</div>
  </td>
</tr>
	<tr>
		<td class="menu" valign="top" align="center">
			<div class="lang">
				<a href="<?=str_replace(array('/ua/','/en/'),'/ru/',$_SERVER['REQUEST_URI'])?>" class="<?=($lang == "ru")?('a'):('n')?>">ru</a>
				<a href="<?=str_replace(array('/ru/','/ua/'),'/en/',$_SERVER['REQUEST_URI'])?>" class="<?=($lang == "en")?('a'):('n')?>">en</a>
				<!--<a href="<?=str_replace(array('/ru/','/en/'),'/ua/',$_SERVER['REQUEST_URI'])?>" class="<?=($lang == "ua")?('a'):('n')?>">ua</a>-->
				<div class="clear"></div>
			</div>
			
			<table cellspacing="0" cellpadding="0" class="addmod">
				<tr><th>Модули</th></tr>
				<tr><td><a href="/<?=$lang?>/edit/1/">Контент</a></td></tr>
				<?if($_SESSION['_auth_id']==1){?>
					<tr><td><a href="/_s/types.php">структура</a></td></tr>
					<tr><td><a href="/_s/l_adm.php">Пользователи CMS</a></td></tr>
				<?}?>
			</table>
		</td>
		<td class="content" valign="top">
			<div class="main">
				<div class="path">
					<?
					$curr = $I['id'];
					$arr = array();
					while($curr) {
						$query = "SELECT id,parent,name_".$lang." FROM pages WHERE id='$curr' LIMIT 1";
						$res_breadcrumbs = DB::fetchAssoc(DB::query($query));
						$arr[] = "<a href='/".$lang."/edit/".$res_breadcrumbs['id']."/'>".$res_breadcrumbs['name_'.$lang]."</a>";
						$curr = $res_breadcrumbs['parent'];
					};
					if(is_array($arr)){
						$str = join('', array_reverse($arr));
						echo $str;
					}
					if(!$relocate && $I['parent']!='0'){
						$relocate = url($I['id'],1);
					}
					?>
				</div>
				<div class="clear"></div>
			<br>

<? } else if($include=='footer') { ?>

			</div>
		</td>
	</tr>
</table>
</body>
</html>

<? } else { die(); } ?>