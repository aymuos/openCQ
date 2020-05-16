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
else
 {

	

$url=location."teacher_group_info.php";
$data = array(		"key" => key,
					"stream" => 1,
					"batch_passout_year" => 1,
					"joining_year" => 1,
				);
$result = send_get_request($url,$data);

//echo $result;

$ans = json_decode($result);
// var_dump($ans);
// exit();

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
		str+=data["designation"] + "</td><td>";
		str+=data["address"] + "</td><td>";
		str+=data["email"] + "</td><td>";
		str+=data["contact no"] + "</td><td>";
		str+= "<button class=\'btn-floating btn-small waves-effect pulse waves-light red darken-1\' onclick=\'delete_student(\"";
		str+=data["username"] + "\")\'><i class=\'material-icons\'>cancel</i></button></td></tr>";
		return str;
	}

	

	
	$(document).ready(function(){
		$("select").change(function(){
			const stream = $("#stream").children("option:selected").val();
			// $.get("get_teacher_info.php?stream="+stream, function(data, status){
			// 	var obj = jQuery.parseJSON(data);
			// 	if(obj.status == "FAIL"){
			// 		M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
			// 	}
			// 	else{
			// 		var str = "";
			// 		for(i=0;i<obj.result.length;i++){
			// 			str += prepare(obj.result[i]);
			// 		}
			// 		$("#tableBody").html(str);
			// 	}
			// });

			// nodes.forEach(
			// 	(nd)=>{
			// 		let toMatch = nd.children[2];
			// 		if((stream!=toMatch.textContent) && (stream!="ALL")){
			// 			nd.style.display="none";
			// 		}
			// 		else{
			// 			nd.style.display="";
			// 		}
			// 	}
			// );

			Array.from(nodes).forEach(
					(nd)=>{
							let toMatch = nd.children[2];
							if((stream!=toMatch.textContent) && (stream!="ALL")){
								nd.style.display="none";
							}
							else{
								nd.style.display="";
							}
						}
			);
		});
	});
	
	
	
	
	function delete_teacher(x){
		if(confirm("The corresponding student will be deleted. Do you want to continue?")==true){
		$.get("delete_teacher.php?username="+encodeURIComponent(x), function(data, status){
			var obj = jQuery.parseJSON(data);
			if(obj.status == "FAIL"){
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
			}
			else{
				M.toast({html: obj.comment+"! :(",classes: \'rounded\'});
				var stream = $("#stream").children("option:selected").val();
				$.get("get_techer_info.php?stream="+stream, function(data, status){
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
	<nav>
    <div class="row">
	<div class="nav-wrapper black  z-depth-5 col s12">
	<div class="left-logo">
				<img src="img/logo256.png" class="ing">
			</div>
    <label class="brand-logo center"><a href ="coe_dashboard.php"> VIEW ALL TEACHERS - COE USERSPACE </a><i class="material-icons">portrait</i></label>
    
      <ul id="nav-mobile" class="right ">
		<li><a style="display:none" role="button" class="btn waves-effect waves-light z-depth-3 deep-purple darken-4" href="student-details.php">Account</a></li>
        <li><a role="button" class="btn waves-effect waves-light grey darken-4 z-depth-3 ing2 amber-text" href="logout.php" >LOGOUT<i class="material-icons left">input</i></a></li>
    
        
            </ul>
        </div>
    </div>
  </nav>
	
	
	
    <div class="container z-depth-5 grey-blue darken-4" style="background-color: #e6e6e6;width: 1200">
      <h2 class="header center cyan-text">Teachers</h2>
    <div class="container inner-card">
	
	
	
	
	<div class="input-field" style="width: 300px;display: inline-block;float: left">
    <select id="stream">
      <option value="1">All</option>
      <option value="CSE">CSE</option>
      <option value="IT">IT</option>
      <option value="CT">CT</option>
      <option value="BSEH">BSEH</option>
    </select >
    <label class="cyan-tex" style="font-size: 16;"><b>Stream:</b></label>
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
              <th>Designation</th>
              <th>Address</th>
			  <th>Email</th>
			  <th>Contact No</th>
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
			
			echo $ans->result[$ct-1]->{'designation'};
			
			
			
			
            echo '</td><td>';
		
		echo $ans->result[$ct-1]->{'address'};
			
			
			
			
            echo '</td><td>';
			
			
			echo $ans->result[$ct-1]->{'email'};
			
			
			
			
            echo '</td><td>';
			
			
			
			
			echo $ans->result[$ct-1]->{'contact no'};
		  
		  
		  echo '</td><td><button class="btn-floating btn-small waves-effect pulse waves-light red darken-1" onclick="delete_teacher(\''.$ans->result[$ct-1]->{'username'}.'\')"><i class="material-icons">cancel</i></button>
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
				<button class="btn waves-effect waves-light blue" onclick="window.location.href = \'add-teacher.php\'">Add<i class="material-icons right" >person_add</i></button>
               </div>
              </div>
             </div>
            </div>
		 </div>
       </div>
               


<script>
const selection = document.querySelector(\'#tableBody\');
const nodes = selection.children;
</script>



</body>


';


}

?>