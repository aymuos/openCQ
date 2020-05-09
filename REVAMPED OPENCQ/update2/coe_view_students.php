<?php

require('sender_header.php');
//This displays the running exams..........
//Proceed to the else part directly.......



session_start();
if ( isset($_SESSION['loggedincoe']) == false ){
echo ' 
<html>
<head>
<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
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

	

$url=location."student_group_info.php";
$data = array(		"key" => key,
					"stream" => 1,
					"batch_passout_year" => 1,
					"joining_year" => 1,
				);
$result = send_get_request($url,$data);

//echo $result;

$ans = json_decode($result);

echo '

<html>
	<head>
	<link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
		<title>COE Dashboard</title>
		
		
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- BOOTSTRAP AND MATERIALIZE LIBRARIES-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<!-- Compiled and minified JavaScript -->
		<!-- end of bootstrap materialize libraries//  create provision for user css-->       
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
		
		
	
		
		<!--user css-->
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
	$(document).ready(function(){
    $(\'select\').formSelect();
  });


	function prepare(data){
		var str = "<tr><td>";
		str+=data.username + "</td><td>";
		str+=data.name + "</td><td>";
		str+=data.department + "</td><td>";
		str+=data["joining year"] + "</td><td>";
		str+=data["pass out year"] + "</td><td>";
		str+=data["registration no"] + "</td><td>";
		str+=data["email"] + "</td><td>";
		str+=data["contact no"] + "</td><td>";
		str+= "<button class=\'btn-floating btn-small waves-effect pulse waves-light blue darken-4\' onclick=\'year_lag(\"";
		str+=data["username"];
		str+= "\")\'><i class=\'material-icons\'>arrow_downward</i></button>" + "</td><td>";
		str+= "<button class=\'btn-floating btn-small waves-effect pulse waves-light red darken-1\' onclick=\'delete_student(\"";
		str+=data["username"] + "\")\'><i class=\'material-icons\'>cancel</i></button></td></tr>";
		return str;
	}

	
	
	
	$(document).ready(function(){
		$("select").change(function(){
			var stream = $("#stream").children("option:selected").val();
			var join = $("#join").children("option:selected").val();
			var pass = $("#pass").children("option:selected").val();
			$.get("get_student_info.php?stream="+stream+"&join="+join+"&pass="+pass, function(data, status){
				var obj = jQuery.parseJSON(data);
				if(obj.status == "FAIL"){
					M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
				}
				else{
					var str = "";
					for(i=0;i<obj.result.length;i++){
						str += prepare(obj.result[i]);
					}
					$("#tableBody").html(str);
				}
			});
		});
	});
	
	
	function year_lag(x){
		if(confirm("The pass out year of the corresponding student will increase by 1. Do you want to continue?")==true){
		$.get("year_lag_student.php?username="+encodeURIComponent(x), function(data, status){
			var obj = jQuery.parseJSON(data);
			if(obj.status == "FAIL"){
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
			}
			else{
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
				var stream = $("#stream").children("option:selected").val();
				var join = $("#join").children("option:selected").val();
				var pass = $("#pass").children("option:selected").val();
				$.get("get_student_info.php?stream="+stream+"&join="+join+"&pass="+pass, function(data, status){
					var obj = jQuery.parseJSON(data);
					if(obj.status == "FAIL"){
						M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
					}
					else{
						var str = "";
						for(i=0;i<obj.result.length;i++){
							str += prepare(obj.result[i]);
						}
						$("#tableBody").html(str);
					}
				});
			}
		});
		}
	}
	
	
	function delete_student(x){
		if(confirm("The corresponding student will be deleted. Do you want to continue?")==true){
		$.get("delete_student.php?username="+encodeURIComponent(x), function(data, status){
			var obj = jQuery.parseJSON(data);
			if(obj.status == "FAIL"){
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
			}
			else{
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
				var stream = $("#stream").children("option:selected").val();
				var join = $("#join").children("option:selected").val();
				var pass = $("#pass").children("option:selected").val();
				$.get("get_student_info.php?stream="+stream+"&join="+join+"&pass="+pass, function(data, status){
					var obj = jQuery.parseJSON(data);
					if(obj.status == "FAIL"){
						M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
					}
					else{
						var str = "";
						for(i=0;i<obj.result.length;i++){
							str += prepare(obj.result[i]);
						}
						$("#tableBody").html(str);
					}
				});
			}
		});
		}
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
				<a class="ing2" href="logout.php"><i class="material-icons left">input</i>Logout</a>
			</div>
		</div>
	
	
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: #e6e6e6;width: 1200">
      <h2 class="header center cyan-text">Students</h2>
    <div class="container inner-card">
	
	
	
	
	<div class="input-field" style="width: 300px;display: inline-block;float: left">
    <select id="stream">
      <option value="1">All</option>
      <option value="CSE">CSE</option>
      <option value="IT">IT</option>
      <option value="CT">CT</option>
    </select >
    <label class="cyan-tex" style="font-size: 16;"><b>Stream:</b></label>
  </div>
	<div class="input-field" style="width: 300px;display: inline-block">
    <select id="join">
      <option value="1" selected>All</option>';
	  
	  $year = date("Y"); 
	  for($i=2016;$i<=$year;$i++)echo '<option value="'.$i.'">'.$i.'</option>';
	  
	  
      echo '</select>
    <label class="cyan-tex" style="font-size: 16;"><b>Joining Year</b></label>
  </div>
	<div class="input-field" style="width: 300px;float: right">
    <select id="pass">
      <option value="1" selected>All</option>';
	  
	  $year = date("Y"); 
	  for($i=2016;$i<=$year;$i++)echo '<option value="'.($i+4).'">'.($i+4).'</option>';
	  
	  
      echo '</select>
    <label class="cyan-tex" style="font-size: 16;"><b>Pass Out Year</b></label>
  </div>
	
	
	
      <div class = "row">
         <div class = "col s12">
            <div class = "card-panel ">
               <div class = "card-content" >
              <!--    <span class = "card-title card-large s12"><h3 class="runningexams"> EXAMINATIONS</h3></span> -->
                  
	<table class="highlight centered highlight" >
        <thead>
          <tr>
              <th>Roll No</th>
              <th>Name</th>
              <th>Stream</th>
              <th>Joining Year</th>
              <th>Pass out Year</th>
			  <th>Registration No</th>
			  <th>Email</th>
			  <th>Contact No</th>
			  <th>Year Lag</th>
			  <th>Delete</th>
          </tr> 
        </thead>




        <tbody font="Helvetica" id="tableBody">';
		
		
		
		$ct = 1; //Donot delete this variable.........
		
		
		//Put all the running exam's details here.........
		
		$len = count($ans->{'result'});
		for($ct=1;$ct<=$len;$ct++){
		
		echo '
          <tr>
            <td>';
			echo $ans->result[$ct-1]->username;
			echo '</td>
            <td>';
			
			
			
			//Put the paper name here...............
			echo $ans->result[$ct-1]->name;
			
			
			
			echo '</td>
            <td>';
			
			echo $ans->result[$ct-1]->{'department'};
			
			
			echo '</td><td>';
			
			
			
			
			echo $ans->result[$ct-1]->{'joining year'};
			echo '</td><td>';
			echo $ans->result[$ct-1]->{'pass out year'};
			
			
			
			
			echo '</td><td>';
			
			

				echo $ans->result[$ct-1]->{'registration no'};

			
			
			echo '</td><td>';
			
			
			
			
			echo $ans->result[$ct-1]->{'email'};
			
			
			
			
            echo '</td><td>';
			
			
			
			
			echo $ans->result[$ct-1]->{'contact no'};
			
			
			
			
			
			
			
			echo '</td><td><button class="btn-floating btn-small waves-effect pulse waves-light blue darken-4" onclick="year_lag(\''.$ans->result[$ct-1]->{'username'}.'\')"><i class="material-icons">arrow_downward</i></button>';
		  
		  
		  echo '</td><td><button class="btn-floating btn-small waves-effect pulse waves-light red darken-1" onclick="delete_student(\''.$ans->result[$ct-1]->{'username'}.'\')"><i class="material-icons">cancel</i></button>
          </td></tr>';
		  
		
		  
		}
		
		
		
		
		
		
		
		//Rest of the part remains same.....
		
          echo '
        </tbody>
      </table>
	  ';
	  
	  
		$ct=0;	//If there is no test to display then satisfy the if condition.
		if(!$len){
			echo '<br><p style="font-size: 20;">No Student to Display</p>';
		}
			
			
			
			
			
		//Rest of the part remains same.
		echo '<button class="btn waves-effect waves-light red" onclick="window.location.href = \'coe_dashboard.php\'">Back<i class="material-icons left" >navigate_before</i></button>
				<button class="btn waves-effect waves-light blue">Add<i class="material-icons right" >person_add</i></button>
               </div>
              </div>
             </div>
            </div>
		 </div>
       </div>
               






</body>


';


}

?>