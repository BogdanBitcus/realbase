function screenSize() {
    var w, h;
    w = (window.innerWidth ? window.innerWidth : (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.offsetWidth));
    h = (window.innerHeight ? window.innerHeight : (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.offsetHeight));
    return {w:w, h:h};
}

$(document).ready(function(){
	
	
	var flag_give = 0;
	var flag_get = 0;
	var operation = 'BTC_TO_UAH'; 
	// BTC_TO_UAH
	// UAH_TO_BTC
	
	
	$('#show_give').click(function(){
		if(flag_give==1){
			flag_give = 0;
			$(this).next('.selection_cont').stop().animate({'height':'50px'},200);
		} else {
			flag_give = 1;
			$('.selection_cont').stop().animate({'height':'50px'},200);
			$(this).next('.selection_cont').stop().animate({'height':'100px'},200);
		}
	});
	
	
	$('#show_get').click(function(){
		if(flag_get==1){
			flag_get = 0;
			$(this).next('.selection_cont').stop().animate({'height':'50px'},200);
		} else {
			flag_get = 1;
			$('.selection_cont').stop().animate({'height':'50px'},200);
			$(this).next('.selection_cont').stop().animate({'height':'100px'},200);
		}
	});
	
	
	$('#give_uah').click(function(){
		var poss = $(this).parent().find('div').index($(this))
		if(poss>0){
			operation = 'UAH_TO_BTC';
			$(this).parent().css({'height':'50px'});
			$(this).parent().prepend($(this));
			$('#get_btc').parent().prepend($('#get_btc'));
			flag_give = 0;
		}
		calculate();
	});
	
	
	$('#give_btc').click(function(){
		var poss = $(this).parent().find('div').index($(this))
		if(poss>0){
			operation = 'BTC_TO_UAH';
			$(this).parent().css({'height':'50px'});
			$(this).parent().prepend($(this));
			$('#get_uah').parent().prepend($('#get_uah'));
			flag_give = 0;
		}
		calculate();
	});
	
	
	$('#get_uah').click(function(){
		var poss = $(this).parent().find('div').index($(this))
		if(poss>0){
			operation = 'BTC_TO_UAH';
			$(this).parent().css({'height':'50px'});
			$(this).parent().prepend($(this));
			$('#give_btc').parent().prepend($('#give_btc'));
			flag_get = 0;
		}
		calculate();
	});
	
	
	$('#get_btc').click(function(){
		var poss = $(this).parent().find('div').index($(this))
		if(poss>0){
			operation = 'UAH_TO_BTC';
			$(this).parent().css({'height':'50px'});
			$(this).parent().prepend($(this));
			$('#give_uah').parent().prepend($('#give_uah'));
			flag_get = 0;
		}
		calculate();
	});
	
	
	function calculate(){
		if(operation == 'BTC_TO_UAH'){
			var give_value = $('#give_value').val();
			var get_value = $('#get_value').val();
			$('#give_value').val(get_value);
			$('#get_value').val(give_value);
		} else if(operation == 'UAH_TO_BTC'){
			var give_value = $('#give_value').val();
			var get_value = $('#get_value').val();
			$('#give_value').val(get_value);
			$('#get_value').val(give_value);
		} else {
			// -
		}	
	}
	
	
	$('#give_value').keyup(function(){
		if(operation == 'BTC_TO_UAH'){
			var give_value = $('#give_value').val();
			var get_value = give_value*UAH_PER_BTC;
			get_value = get_value.toFixed(0);
			$('#get_value').val(get_value);
		} else if(operation == 'UAH_TO_BTC'){
			var give_value = $('#give_value').val();
			var get_value = give_value/UAH_PER_BTC;
			get_value = get_value.toFixed(8);
			$('#get_value').val(get_value);
		} else {
			// -
		}	
	});
	
	
	$('#give_value').change(function(){
		if(operation == 'BTC_TO_UAH'){
			var give_value = $('#give_value').val();
		} else if(operation == 'UAH_TO_BTC'){
			var give_value = $('#give_value').val();
			if(give_value<200){
				alert('Минимальная сума 200 ГРН');
			}
			if(give_value>150000){
				alert('Максимальная сума 150000 ГРН');
			}
		} else {
			// -
		}	
	});



	$('#give_value, #get_value').keypress(function(e) {
		/*console.log(e.key);
		if ((e.key < '0' || e.key > '9') && e.key != '.') {
			return false;
		}*/
	});
	
	
	$('#golosovanie input[type="radio"]').click(function(){ // голосовалка
		var otv = parseInt($(this).data('otv'));
		var vopr = parseInt($(this).data('vopr'));
		$.getJSON(
	        "/ajax/vois.php",
	        {
	            otv : otv,
	            vopr : vopr
	        }, function (d) {
	            if(d.results==1){
					console.log('Ваш голос принят!');
					$('#vois_results_'+vopr).html(d.html);
				}
	        }
	    );
	});
	
	
	$('.close_error').click(function(){
		$(this).parent().animate({'opacity':'0'},400,function(){
			$(this).hide();
		})
	});
	
	
	
	
});

