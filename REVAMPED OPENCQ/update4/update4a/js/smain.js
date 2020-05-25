function func(){
	M.toast({html: 'please Wait&nbsp;! :)',classes: 'rounded'});
	document.getElementById("iun").style.opacity = "0";
	document.getElementById("id").style.borderColor = "#00b300";
	document.getElementById("id").style.borderBottom = "1px solid #00b300";
	document.getElementById("id").style.boxShadow = "0 1px 0 0 #00b300";
	document.getElementById("pwd").style.opacity = "0";
	document.getElementById("pass").style.borderColor = "#00b300";
	document.getElementById("pass").style.borderBottom = "1px solid #00b300";
	document.getElementById("pass").style.boxShadow = "0 1px 0 0 #00b300";
	var uname = document.getElementById("id").value;
	var pass = document.getElementById("pass").value;
	var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				M.Toast.dismissAll();
				//alert(this.responseText);
                var res = JSON.parse(this.responseText);
				var stm = 'incorrect username: '+ uname;
				
				if(res.status == 'FAIL'){
					M.Toast.dismissAll();
					if(res.comment == stm){
						document.getElementById("iun").style.opacity = "1";
						document.getElementById("id").style.borderColor = "#ffb31a";
						document.getElementById("id").style.borderBottom = "1px solid #ffb31a";
						document.getElementById("id").style.boxShadow = "0 1px 0 0 #ffb31a";
					}
					else if(res.comment == 'incorrect password'){
						document.getElementById("pwd").style.opacity = "1";
						document.getElementById("pass").style.borderColor = "#ffb31a";
						document.getElementById("pass").style.borderBottom = "1px solid #ffb31a";
						document.getElementById("pass").style.boxShadow = "0 1px 0 0 #ffb31a";
						document.getElementById("pass").value ="";
					}
					else{
						M.toast({html: res.comment,classes: 'rounded'});
					}
				}
				else{
					if(res['is first login']=="no"){
						location.href = "student_dashboard.php";
					}
					else{
						location.href = "student-details.php";
					}
				}
            }
        };
    xhttp.open("POST", "student-login2.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+encodeURIComponent(uname)+"&password="+encodeURIComponent(pass));
	 
}
