//following is to have the left navbar






document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {
        edge:left,
        draggable:true,
        inDuration:250,
        outDuration:200

    });
  });





//following js for tabs

document.addEventListener("DOMContentLoaded",function(){
    const variableName = document.querySelector('.tabs');
        M.Tabs.init(variableName,{
            swipeable: false,
            duration: 200
            
        });
    })


//following js for back-to-top button
//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 


function save_opt(q_num,q_id){
	
	var radios = document.getElementsByName("option"+q_num);
	var id = 0;
	for(var i = 0 ; i<radios.length ; i++){
		if(radios[i].checked == true){
			id = radios[i].value;
		}
	}
	//alert(id);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
			save_color_tab(q_num);
			document.getElementById("trt"+q_num).innerHTML = this.responseText;
			setTimeout(function(){ document.getElementById("trt"+q_num).innerHTML = "" ; }, 3000);
      }
    };
    xmlhttp.open("GET", "save_ans.php?qid=" + q_id + "&opt="+id, true);
    xmlhttp.send();
}

function color_tab(id){
	//alert(document.getElementById("tab"+id).style.backgroundColor);
	if(document.getElementById("tab"+id).style.backgroundColor != "rgba(41, 224, 169, 0.576)"){
		document.getElementById("tab"+id).style.backgroundColor = "#ffd699";
		document.getElementById("htab"+id).style.color = "#cc5200";
	}
}
function save_color_tab(id){
	document.getElementById("tab"+id).style.backgroundColor = "hsla(162, 75%, 52%, 0.575)";
	document.getElementById("htab"+id).style.color = "#666666";
}

function onTimerElapsed(){
	var sec = document.getElementById("secs").innerHTML ;
	sec++;
	sec = sec%60;
	if(sec == 0){
		var min = document.getElementById("mins").innerHTML ;
		min++;
		min = min%60;
		if(min == 0){
			var hr = document.getElementById("hrs").innerHTML ;
			hr++;
			document.getElementById("hrs").innerHTML = hr;
		}
		if(min < 10)
			document.getElementById("mins").innerHTML = "0" + min;
		else document.getElementById("mins").innerHTML =  min;
	}
	if(sec < 10 ){
		document.getElementById("secs").innerHTML = "0" + sec;
	}
	else 
		document.getElementById("secs").innerHTML = sec;
}

var ok=1;
var elem = document.documentElement;
var myVar;   
var full_screen = 0;
var change_window = 0;
			
//This function makes the screen to go full mode
function openFullscreen() {
	ok=1;
	document.getElementById("initial_message").style.display = "none";
	if(full_screen == 0){
		document.getElementById("exam_page").style.display = "block";
		document.getElementById("initial-head").style.display = "none";
	}
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.mozRequestFullScreen) { /* Firefox */
		elem.mozRequestFullScreen();
	} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) { /* IE/Edge */
		elem.msRequestFullscreen();
	}
	full_screen = 1;
}
			
			
//This screen checks whether the window is in full screen or not every second
$(document).ready(function(){
	myVar = setInterval("showTime()", 1000);
});

function isFullscreen(){ return 1 >= outerHeight - innerHeight };


//Checks if the window is in full screen or not and prints the necessary messages
function showTime(){
	if (!document.hasFocus() && full_screen == 1 && change_window < 2) {
		document.getElementById("exam_page").style.display = "none";
		document.getElementById("initial-head").style.display = "block";
		change_func();
		change_window++;
	}
	else if (!document.hasFocus() && full_screen == 1 && change_window >= 2) {
		submit_paper();
	}
	if(full_screen == 1){
		if (!isFullscreen()) {
			document.getElementById("exam_page").style.display = "none";
			document.getElementById("warning_message").style.display = "block";
			document.getElementById("initial-head").style.display = "block";
			if(ok == 1){
				timeout();
				ok=0;
			}
		}
		else{
			document.getElementById("warning_message").style.display = "none";
			clearInterval(variable);
			document.getElementById("time").innerHTML = 6;
			document.getElementById("exam_page").style.display = "block";
			document.getElementById("initial-head").style.display = "none";
		}
	}
}
	
			
//This function runs the down counter
function timeout(){
	variable = setInterval("down_counter()", 1000);		
}
	
//Displays counter in reverse manner
function down_counter(){
	var x = document.getElementById("time").innerHTML;
	if(x == 0){
		clearInterval(variable);
		submit_paper();
	}
	else{
		document.getElementById("time").innerHTML = x-1;
	}
}
		
//Displays Thankyou message
function final_func(){
	document.getElementById("warning_message").style.display = "none";
	document.getElementById("exam_page").style.display = "none";
	document.getElementById("final_message").style.display = "block";
	document.getElementById("initial-head").style.display = "block";
	full_screen = 0;
}

//Displays a warning if the window is changed
function change_func(){
	alert("WARNING: Changing window again will automatically end your exam!");
}
		//Prevents up down etc arrow  key
$(document).keydown(function(e) {
	if(e.which >= 37 && e.which <= 40){
		e.preventDefault();
	}
});


//Prevents F5 refresh
$(document).ready(function() {
$(window).keydown(function(event){
		if(event.keyCode == 116) {
			event.preventDefault();
			return false;
		}
	});
});

//Prevents F12
$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});		
			

//Prevents right click
$(document).bind("contextmenu",function(e){
  return false;
});


/* Close fullscreen */
function closeFullscreen() {
	
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}




$(elem).attr('unselectable','on')
     .css({'-moz-user-select':'-moz-none',
           '-moz-user-select':'none',
           '-o-user-select':'none',
           '-khtml-user-select':'none', /* you could also put this in a class */
           '-webkit-user-select':'none',/* and add the CSS class here instead */
           '-ms-user-select':'none',
           'user-select':'none'
     }).bind('selectstart', function(){ return false; });
	 
	 
	 

function submit_paper(){
	len = document.getElementById("no_ques").value;
	closeFullscreen();
	final_func();
	var i;
	var str = "submit_ans.php?";
	var xmid = document.getElementById("xmid").value;
	str = str + "exam_id=" + xmid ;
	for(i=1;i<=len;i++){
		str = str + "&qid" + i + "=" + document.getElementById("ques_id"+i).value;
		var radios = document.getElementsByName("option"+i);
		var id = 0;
		for(var j = 0 ; j<radios.length ; j++){
			if(radios[j].checked == true){
				id = radios[j].value;
			}
		}
		str = str + "&opt" + i + "=" + id;
	}
	//alert(str);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
      }
    };
    xmlhttp.open("GET", str, true);
    xmlhttp.send();
}