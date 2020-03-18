<?php $include = 'header'; include(VIEW_PATH."borders.index.php"); ?>

	home page <br>
	<a href='/ru/cabinet/' class='check_click'>переход в кабинет</a>
	<br>
	<br>
	<a href='javascript:void(0);' id='close-realbase'>Закрыть виджет</a>
	<script>
	(function(){
		
		// инициализация
		window.parent.postMessage('widget-initialized', '*');
		
		
		
		$('#close-realbase').click(function(){
			window.parent.postMessage('close-realbase', '*');
			//window.parent.postMessage(JSON.stringify({data:'close-realbase'}), '*');
		});
		
		
		$('.check_click').click(function(){
			window.parent.postMessage($(this).attr('href'), '*');
			//window.parent.postMessage(JSON.stringify({data:'close-realbase'}), '*');
		});
		
	})();
	</script>

<?php $include = 'footer'; include(VIEW_PATH."borders.index.php");?>
