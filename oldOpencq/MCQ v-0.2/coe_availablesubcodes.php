<?php



include 'db_connection.php';


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

echo '
<html>
	<head>
		<title>Welcome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    	<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
	
		<link rel="stylesheet" type="text/css" href="temp.css">
		<script>
			$(document).ready(function(){
				$(".modal").modal();
			});
		</script>
		<script>
			$( function() {
				$( "input" ).checkboxradio();
			});
  
			function delete_code(cid){
				if(confirm("Are you sure you want to delete Paper Code : " + cid + " ?")){
					window.location.href = "coe_delete_codes.php?cid=" + cid ;
				}
			}
		</script>
	</head>
	<body>

		<div class="heading">
			<div class="left-logo">
				<img src="logo256.png" class="ing">
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
										<th>SUBJECT CODE</th>
										<th>PAPER NAME</th>
										<th>UG/PG</th>
										<th>DEPARTMENT NAME</th>
										<th>DELETE</th>
									</tr>
								</thead>
								<tbody>';
								
								$conn = OpenCon();

								$query = "SELECT * FROM subject";
								execute($conn,$query,"",[],$stmt);
								$res = get_data($stmt);
								close($stmt);

								//Print all the subject's details one by one..
								foreach($res as $value){
									echo '<tr><td>';
									
									
									//Put the subject code here......
									echo $value['id'];
									
									
									echo '</td><td>';
									
									//Put the paper name here..........
									echo $value['name'];
									
									
									echo '</td><td>';
									
									
									//Put either UG or PG here........
									if($value['UG'] == '1'){
										echo 'UG';
									}
									else{
										echo 'PG';
									}
									
									
									
									echo '</td><td>';
									
									
									//Put the department here....
									echo $value['department'];
									
									
									
									echo '</td><td><button class="btn-floating btn-small waves-effect pulse waves-light red" onclick="delete_code(\'';
									
									
									//Put the subject code here again..........
									echo $value['id'];
									
									
									
									echo '\')"><i class="material-icons">delete</i></button></td>
									</tr>';
									
									
									
								}
									
							echo '</tbody></table>
						
						<button class="btn waves-effect waves-light red" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
						<a class="btn waves-effect waves-light green" href="#modal1">Add subjectcode
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
		<form method="post" action="coe_add_subcodes.php">
			<label>Paper Code : </label>&emsp;
			<input type="text" name="pcode" style="width: 250px;" required>
			<br>
			<label>Paper Name : </label>&emsp;
			<input type="text" name="pname" style="width: 250px;" required>
			<br><br>
			<label style="padding-right: 50px;">UG / PG : </label>
			<div style="width: 100px;display: inline;" >
				<input id="choice_1" name="group1" type="radio"  style="opacity:1;font: 40;display: inline;margin-top: 8px;" value="UG" required>
				<label for="choice_1" style="padding-left: 20px;padding-right: 30px;">UG</label>
		
				<input id="choice_2" name="group1" type="radio" style="opacity:1;margin-top: 8px;" value="PG" />
				<label for="choice_2" style="padding-left: 20px;padding-right: 30px;">PG</label>
			</div>
			<br><br>
			<label style="padding-right: 50px;">Department : </label>
			<div style="width: 100px;display: inline;" >
				<input id="dchoice_1" name="dept" type="radio"  style="opacity:1;font: 40;display: inline;margin-top: 8px;" value="CSE" required>
				<label for="dchoice_1" style="padding-left: 20px;padding-right: 30px;">CSE</label>
		
				<input id="dchoice_2" name="dept" type="radio" style="opacity:1;margin-top: 8px;" value="IT"/>
				<label for="dchoice_2" style="padding-left: 20px;padding-right: 30px;">IT</label>
		
				<input id="dchoice_3" name="dept" type="radio" style="opacity:1;margin-top: 8px;" value="CT"/>
				<label for="dchoice_3" style="padding-left: 20px;padding-right: 30px;">CT</label>
			</div>
	
	</div>
		<div class="modal-button">
			<button class="btn waves-effect waves-light btn-check" type="submit">Add<i class="material-icons right" >check</i></button>
			<button class="btn waves-effect waves-light btn-cancel modal-close" >Cancel<i class="material-icons right">cancel</i></button>
		</div>
	</form>
	</div>

</body>';




}



?>