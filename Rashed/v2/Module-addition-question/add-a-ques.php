<?php


//This file takes the question statement and options from the user.
//Please proceed to the else part directly.



session_start();
if ( isset($_SESSION['loggedinmaster']) == false ){
echo ' 
<html>
<head>
  <title>Oops!!!</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
<body>
	<div class="well-lg">
		<div class="alert alert-danger">
			<p class="text-center">Please <a href="master.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {


	if(isset($_GET["ques_id"])){
		$id = $_GET["ques_id"];		//If this condition is satisfied then it means that there is a question 
	}								//with same question id hence display the questions/options/image link 
									//where ever necessary . Else don't put anything



echo '

<html>
<head>
<title>Add a Question</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="destroy.css">
		<script>
		function func(){
			var x = document.getElementById("prob-stm").value;
			var a = document.getElementById("1").value;
			var b = document.getElementById("2").value;
			var c = document.getElementById("3").value;
			var d = document.getElementById("4").value;
			document.getElementById("p1").value = x;
			document.getElementById("opt1").innerHTML = "a) "+ a;
			document.getElementById("opt2").innerHTML = "b) "+b;
			document.getElementById("opt3").innerHTML = "c) "+c;
			document.getElementById("opt4").innerHTML = "d) "+d;
			
			
			;
			var currWidth = document.getElementById("img_disp").naturalWidth;
			if(currWidth >800){
				document.getElementById("img_disp").style.width = "100%";
			}
			else{
				document.getElementById("img_disp").style.width = "";
			}
			
		}
		
		
		function load_image(){
			
			var currWidth = document.getElementById("haland").naturalWidth;
			if(currWidth >800){
				document.getElementById("haland").style.width = "100%";
			}
			else{
				document.getElementById("haland").style.width = "";
			}
		}
		
		

		
		function upload_image(){
			document.getElementById("boolean").value = 0;
			document.getElementById("image_form").submit();
		}
		function submit_form(){
			document.getElementById("boolean").value = 1;
			document.getElementById("image_form").submit();
		}
		
		
		$(document).ready(function() {
			$("#just").on("paste", function(e) {
				var orgEvent = e.originalEvent;
				for (var i = 0; i < orgEvent.clipboardData.items.length; i++) {
					if (orgEvent.clipboardData.items[i].kind == "file" && orgEvent.clipboardData.items[i].type == "image/png") {
						var imageFile = orgEvent.clipboardData.items[i].getAsFile();
						var fileReader = new FileReader();
						fileReader.onloadend = function() {
							$("#result").html(fileReader.result);
							document.getElementById("just").style.display = "none";
							document.getElementById("haland").src = fileReader.result;
							document.getElementById("img_disp").src = fileReader.result;
							document.getElementById("haland").style.display = "block";
							document.getElementById("clp_img").value = fileReader.result;
						}
						fileReader.readAsDataURL(imageFile);
						break;
					}
				}
			
			});
		});
		
		function delete_img(){
			document.getElementById("haland").src = "";
			document.getElementById("img_disp").src = "";
			document.getElementById("haland").style.display = "none";
			document.getElementById("just").style.display = "block";
			
			window.location.href = "delete_image_server.php?ques_id=';
			
			if(isset($_GET["ques_id"])){
				echo $_GET["ques_id"];
			}
			
			
			echo '";
			
			
		}
		
		function check_user(x){
			if(x == ""){
				document.getElementById("updbtn").disabled = true;
			}
			else{
				document.getElementById("updbtn").disabled = false;
			}
		}
		
		
		
		var textarea = document.querySelector("textarea");
		textarea.addEventListener("keydown", autosize);             
		function autosize(){
			alert("sds");
			var el = this;
			setTimeout(function(){
				el.style.cssText = "height:auto; padding:0";
				// for box-sizing other than "content-box" use:
				// el.style.cssText = "-moz-box-sizing:content-box";
				el.style.cssText = "height:" + el.scrollHeight + "px";
			},0);
		}
		
		
		
		
		
		
		</script>
		<script>
		// Applied globally on all textareas with the "autoExpand" class
		$(document)
		.one(\'focus.box\', \'textarea.box\', function(){
			var savedValue = this.value;
			this.value = \'\';
			this.baseScrollHeight = this.scrollHeight;
			this.value = savedValue;
		})
		.on(\'input.box\', \'textarea.box\', function(){
			var minRows = this.getAttribute(\'data-min-rows\')|0, rows;
			this.rows = minRows;
			rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
			this.rows = minRows + rows;
			document.getElementById("p1").rows = this.rows;
		});

</script>
		
		
		
		
		
</head>
<body id="page9">
	<div class="some" >
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				<img class="logo" border="50" src="logo.png" alt="Avatar"></img>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<font face="verdana" color="white" size="6.5px" > Dashboard</font>
					<a href="master-dashboard.php" style="text-decoration: none;opacity: 0.8"><font face="verdana" color="white" size="3px"  > &emsp;Home</font></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Account</a></li>
						<li><a href="master.html"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<h1><b>Add a Question</b></h1>
	












<div class="container">
  <form class="form-inline" method="post"  action="upload.php" enctype="multipart/form-data" id="image_form">
    <div class="form-group">
      <label for="email">Select the chapter <span style="color:red;">*</span></label>
        <select class="del-form-control" name="chapter-name">
		
		
		
		
		';
		
		
		
		
	//***Please modify this portion to display all the chapters in the dropdown list.***\\\
	
	//Simply take all the chapter's name from the database and display it.
	
	$len = 5;	//"len" contains the total no of chapters to be displayed.
	for($i = 1; $i <= $len ; $i+=1){		
		echo '<option value="';
		
		
		
		//Print the chapter id here.......
		echo $i+5;
		
		
		
		
		
		echo '" ';
		
		
		
		//If the question belong to the current chapter then the if condition is satisfied
		if($i == 3){
			echo 'selected >';
		}
		else{
			echo '>';
		}
		
		
		
		//Please put the chapter's name in this echo statement.
		echo $i;
		
		
		echo '</option>';
	}		


	


	echo '	
	</select>
    </div>
	<div>
	
	<input type="text" name="ques_id" value="';
	
	
	//please put the question id here if exists.
	echo '123';
	
	
	echo '" readonly hidden>
	
	
	
	<label class="ques">Question:</label>
	<textarea id="prob-stm" class="box" type="text" placeholder="Problem Statement......" name="problem-statement">';
	
	
	
	//Put the problem statement here if exists
	echo 'Put the problem statement here if exists';

	
	
	echo '</textarea>
	</div>
	
	<div class="paste_img" >
		<img src="';
		
		
		if(isset($_GET["upld"])){
			echo $_GET["upld"];
			echo '" style="display: block;"';
		}
		
		
		echo '" onload="load_image()" id="haland" class="final_image" >
		
		
		
		<input type="text" id="clp_img" name="clipboard_image" readonly hidden>
		
		
		
		
		
		
		<div class="message" id="just"';
		
		
		if(isset($_GET["upld"])){
			echo 'style="display: none;"';
		}
		
		
		echo '>Paste ( Ctrl + v ) the image here</div>

	</div>

	<h5 style="padding-top: 10px;"><b>OR</b></h5>
	
	<div class="image_upload">
			<label>Select image to upload:</label>
			<input  type="file" name="fileToUpload" id="fileToUpload" style="display: inline;" onChange="check_user(this.value);">
			<button class="btn btn-primary btn-img" type="button" onclick="upload_image()" id="updbtn" disabled>Upload Image &nbsp;<span class="glyphicon glyphicon-upload iconic"></span></button>
			&emsp;&emsp;&emsp;&emsp;<button class="btn btn-danger btn-img" type="button" onclick="delete_img()">Delete Image</button>';
			if(isset($_GET["upld"])){
				echo '<br><label style="color: green;">Image uploaded successfully!!!</label>';
			}
			
			echo '

	</div>
	
	<input id="boolean" value="0" name="x" readonly hidden>
	
	
	
	
	
	
	<div class="ans">
		<label class="opt">Correct Option <span style="color:red;">* </span>:</label>
		<input id="1" type="text" size="24" placeholder="Correct option" name="correct" value="';



		//Put the correct answer if exists
		echo 'Correct answer';
			



		echo '"		required>
	</div>
	
	<div class="tans">
		<label class="opt">Incorrect Options :</label>
			<input id="2" type="text" size="24" placeholder="Incorrect option 1" name="incorrect1" value="';
			
			
			
			//Put the incorrect answer 1 here.......
			echo 'Put the incorrect answer 1';
			
			
			echo '">
			<input id="3" type="text" size="24" placeholder="Incorrect option 2" name="incorrect2" value="';
			
			//Put the incorrect answer 2 here.......
			echo 'Put the incorrect answer 2';
			
			
			
			echo ' ">
			<input id="4" type="text" size="24" placeholder="Incorrect option 3" name="incorrect3" value="';
			
			
			
			
			//Put the incorrect answer 3 here.......
			echo 'Put the incorrect answer 3';
			
			
			echo '">
	</div>
	
	
	<div class="button-container">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="func()">Preview</button>
		<button type="button" class="btn btn-danger" onclick="location.href=\'master-dashboard.php\'">Cancel</button>
		<button type="button" class="btn btn-success" onclick="submit_form()">Add</button>
	</div>
  </form>
</div>



	











<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Preview</h4>
      </div>
      <div class="modal-body">
        <textarea id="p1" class="box modal-box" type="text" placeholder="Problem Statement......" name="problem-statement" readonly></textarea><br><br>
		<img id="img_disp" class="image_class" src="';
		

		if(isset($_GET["upld"])){
			echo $_GET["upld"];
		}
		
		
		echo '">
			<p id="opt1"></p>
			<p id="opt2"></p>
			<p id="opt3"></p>
			<p id="opt4"></p>
      </div>
      <div class="modal-footer">
		<p class="disc">The final order of the option will change during the test.</p>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>














	

</body>
</html>



';


}

?>
