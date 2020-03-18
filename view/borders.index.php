<? if ($include == 'header') { ?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="site - <?=$I['name_'.$lang]?>" />
	<meta name="description" content="site - <?=$I['name_'.$lang]?>" />
	<title>site - <?=$I['name_'.$lang]?></title>
	<script type="text/javascript" src="/public/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="/public/js/scriptadm.js"></script>
</head>
<body data-template="<?=$I['type']?>" data-lang="<?=$lang?>" class="" data-domen='<?=$_SERVER['HTTP_HOST']?>'>

<div class='global'>

<!--header-->



<? } elseif ($include == 'footer') { ?>



<!--footer-->

</div>
</body>
</html>

<? } else { echo "ERROR PAGE!";}?>
