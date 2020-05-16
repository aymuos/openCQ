<?php

require('sender_header.php');




//This file displays the available subject codes. It can also add new subject codes or
//delete existing om=ne. 
//Proceed to the else part directly..........
//Security has been provided.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
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
			<p class="text-center">Please <a href="coe-login.html">Login</a> first</p>
		</div>
	</div>
</body>
</html>
';
}
else {
	

	$url=location."all_subjects.php";
	$data = array(	"key" => key,);
	
	$result = send_get_request($url,$data);
	
//	echo $result;
	$ans = json_decode($result);
	
	
echo '
<html>
	<head>
		<title>Welcome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="img/brandinglogo.png" type="image/icon type">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    	<!-- Compiled and minified JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
	
		<link rel="stylesheet" type="text/css" href="css/temp.css">
		<script>
			(function ($) {
				$(function () {
					//initialize all modals           
					$(\'.modal\').modal();
					//or by click on trigger
					$(\'.trigger-modal\').modal();
				}); // end of document ready
			})(jQuery); // end of jQuery name space
		</script>
		
		
		<script>

  
			function delete_code(cid){
				if(confirm("Are you sure you want to delete Paper Code : " + cid + " ?")){
					$.get("delete_code.php?code="+cid, function(data, status){
						var obj = jQuery.parseJSON(data);
						if(obj.status == "FAIL"){
							M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
						}
						else{
							location.reload();
						}
					});
				}
			}
			
			
			function add_code(){
				var x = document.getElementById("pcode").value;
				var y = document.getElementById("pname").value;
				$.get("add_code.php?code="+encodeURIComponent(x)+"&name="+encodeURIComponent(y), function(data, status){
					var obj = jQuery.parseJSON(data);
					if(obj.status == "FAIL"){
						M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
					}
					else{
						location.reload();
					}
				});
			}
			
			
			function modify_code(cid,cname){
				$("#modal2").modal("open");
				$("#pNcode").val(cid);
				$("#pNname").val(cname);
			}
			
			function finally_mod(){
				$.get("mod_code.php?code="+encodeURIComponent($("#pNcode").val())+"&name="+encodeURIComponent($("#pNname").val()), function(data, status){
					var obj = jQuery.parseJSON(data);
					if(obj.status == "FAIL"){
						M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
					}
					else{
						location.reload();
					}
				});
			}
			
			
			
		</script>
	</head>
	<body>

		<div class="heading">
			<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
			<label class="writing">Controller of Examination</label>
			<div class="right-logo">
				<a class="ing2" href="coe_logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
		
		<div class="container">
			<div class="row">	
				<div class="col s12">
					<div class="card white darken-1">
						<div class="code-head">
							<b>Subjects Codes</b>
						</div>
					<div class="card-content white-text">
						<div>
							<table class="centered responsive-table">
								<thead>
									<tr>
										<th>Subject Code</th>
										<th>Paper Name</th>
										<th>Modify Paper name</th>
 										<th>Delete</th>
									</tr>
								</thead>
								<tbody>';
								
							
								//Print all the subject's details one by one..
								for($i=0;$i<count($ans->result);$i++){
									echo '<tr><td>';
									
									
									//Put the subject code here......
									echo $ans->result[$i]->code;
									
									
									echo '</td><td>';
									
									//Put the paper name here..........
									echo $ans->result[$i]->name;
									
									
									echo '</td><td>';
									
									echo '<button class="btn-floating btn-small waves-effect pulse waves-light blue" onclick="modify_code(\'';
									
									
									//Put the subject code here again..........
									echo $ans->result[$i]->code;
									
									
									
									echo '\',\'';
									
									
									echo $ans->result[$i]->name;
									
									
									echo '\')"><i class="material-icons">edit</i></button></td><td>';
									
									
									echo '<button class="btn-floating btn-small waves-effect pulse waves-light red" onclick="delete_code(\'';
									
									
									//Put the subject code here again..........
									echo $ans->result[$i]->code;
									
									
									
									echo '\')"><i class="material-icons">delete</i></button></td>
									</tr>';
									
									
									
								}
									
							echo '</tbody></table>
						
						<button class="btn waves-effect waves-light red" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
						<a class="btn waves-effect waves-light green modal-trigger" href="#modal1">Add subjectcode
							<i class="material-icons right">cancel</i></a>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>




<!-- Modal Structure -->
<div id="modal1" class="modal" style="max-height: 100%; overflow: visible">
	<div class="modal-content">
		<h4 style="font-family: comic sans;">Add Subject Code</h4>
		<br>
		<form>
			<label>Paper Code : </label>&emsp;
			<input type="text" id="pcode" style="width: 250px;" required>
			<br>
			<label>Paper Name : </label>&emsp;
			<input type="text" id="pname" style="width: 250px;" required>
		<div class="modal-button">
			<button class="btn waves-effect waves-light btn-check" onclick="add_code()">Add<i class="material-icons right" >check</i></button>
			<button class="btn waves-effect waves-light btn-cancel modal-close" >Cancel<i class="material-icons right">cancel</i></button>
		</div>
	</form>
	</div>
</div>













<div id="modal2" class="modal" style="max-height: 100%; overflow: visible">
	<div class="modal-content">
		<h4 style="font-family: comic sans;">Modify Subject Code</h4>
		<br>
		<form>
			<label>Paper Code : </label>&emsp;
			<input type="text" id="pNcode" style="width: 250px;" readonly>
			<br>
			<label>Paper Name : </label>&emsp;
			<input type="text" id="pNname" style="width: 250px;" required>
		<div class="modal-button">
			<button class="btn waves-effect waves-light btn-check" onclick="finally_mod()">Modify<i class="material-icons right" >check</i></button>
			<button class="btn waves-effect waves-light btn-cancel modal-close" >Cancel<i class="material-icons right">cancel</i></button>
		</div>
	</form>
	</div>
</div>










</body>';




}



?>