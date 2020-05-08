/*$('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });

  $('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });*/
 
 /*
function change(){
	//document.getElementById("selector").style.display = "none";
	var x = document.getElementById("lister").style.display = "block";
}*/



function prepare(key){
	var str = "";

	for(i=0;i<key.length;i++){
		str += "<div class=\"moscow\"><input type=\"checkbox\" value=\"";
		str += key[i] + "\" id=\"";
		str += key[i];
		str += "\" onchange=\"tick(this)\"";
		if(obj[key[i]][1] == 1)str+="checked";
		str += "><label  class=\"rio\"  for=\"" + key[i] + "\">" + key[i] + " (" + obj[key[i]][0] + ")" + "</label></div>";
	}
	$("#long-list").html(str);
	$('input[type=checkbox]').addClass("custom-control-input");
	$(".moscow").each(function(){
		$(this).addClass("custom-control");
		$(this).addClass("custom-checkbox");
	});
	$(".rio").each(function(){
		$(this).addClass("custom-control-label");
	});

}

document.getElementById("inp").addEventListener("click", function() {
	var keys = Object.keys(obj);
	document.getElementById("search-box").value = "";
	prepare(keys);
	document.getElementById("lister").style.display = "block";
	console.log('keydown pressedsdsd');
});
function func(){
	document.getElementById("lister").style.display = "none";
}
//document.addEventListener("DOMContentLoaded", function() {
  
//});

function reload_list(){
	var n = $("#search-box").val();
	var arr = [];
	var keys = Object.keys(obj);
	for(i=0;i<keys.length;i++){
		if(keys[i].startsWith(n.toUpperCase()) == true){
			arr.push(keys[i]);
		}
	}
	prepare(arr);
}


function tick(x){
	console.log("in");
	if(x.checked == true){
		obj[x.value][1] = 1;
		var str = document.getElementById("inp").value;
		if(str == "")document.getElementById("inp").value = x.value;
		else
		document.getElementById("inp").value = str + "-" + x.value;
	}
	else{
		obj[x.value][1] = 0;
		var str = document.getElementById("inp").value;
		var res = str.replace(x.value,"");
		var ans="";
		for(i=0;i<res.length;i++){
			if(res[i]=="-"){
				if(i==0 || i== res.length-1)continue;
				else{
					if(res[i+1] != "-")ans+=res[i];
				}	
			}
			else{
				ans+=res[i];
			}
		}
		document.getElementById("inp").value = ans; 
	}

}

