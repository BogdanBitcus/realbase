function showblock(element)
{
	if($('#' + element).css('display') == "none")
	{
    	$('#' + element).css('display','block');
	} else
	{
    	$('#' + element).css('display','none');
	}
}

function showparenttree(element,lang,parent)
{
	$('#tree_div_' + element).show();
	$.ajax({
		type: "POST",
    	url: '/ajax/getparenttree.php',
    	dataType : "html",
		data: "id=" + element + "&lang=" + lang + "&parent=" + parent,
    	success: function (data, textStatus) {
			$('#img_' + element).hide();
			$('#parenttree_' + element).html(data);
    	}
	});
}

function closetree(element)
{
	$('#tree_div_' + element).hide();
	$('#parenttree_' + element).html('');
}

function changeparent(newid,oldid,lang)
{
	$('#img_' + oldid).show();
	$('#parenttree_' + oldid).html('');
	$.ajax({
		type: "POST",
    	url: '/ajax/changeparent.php',
    	dataType : "html",
		data: "newid=" + newid + "&oldid=" + oldid + "&lang=" + lang,
    	success: function (data, textStatus) {
			document.location.href = data;
    	}
	});
}
function closeimgdiv(element)
{
	$('#' + element).hide();
	return false;
}

function fullimg(element)
{
	$('#' + element).show();
	return false;
}

function delimg(element,id)
{
	$('#' + element).val('');
	$('#prev_div_' + element).hide();
	return false;
}




function edit(id) {
  len = id.innerHTML.length / 1.7;
  if (len < 2) len=2; if (len > 25) len=25;
  str = id.innerHTML.split('"').join('&quot;');
  id.outerHTML = '<input name="'+id.name+'" style="width:'+len+'em;" value="'+str+'" onchange="ch=1">'
}

var ch=0; //changed
function move(id,val) {
  s = document.forms.admingu['position['+id+']'].value;
  document.forms.admingu['position['+id+']'].value=Number(s)+ Number(val);
}

function go(url) {
  if (ch) {
//  if (ch && confirm('Сохранить изменения?')) {
    document.forms.admingu.relocate.value=url;
    document.forms.admingu.submit();
    return false;
  }
  else return true;
}


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


//-------------------------------------------------------------------------------
// Hotkeys
//-------------------------------------------------------------------------------

// key event 
$('html').keydown(function(e){
    
    /** Показать текущий шаблон */
    if(e.ctrlKey && e.altKey && e.which == 84) {
        var tpl = parseInt($('body').data('template'));
        
        if(tpl != "") {
            $.getJSON(
                '/ajax/view_template.php',
                {
                    ajax    : 1,
                    tpl     : tpl
                }, function (d) {
                    if (d.res == 1) {
                        alert ('View - '+d.view+' \n Edit - '+d.edit);
                    }
                }
            );
        }
        return false;
    }

});
  
});