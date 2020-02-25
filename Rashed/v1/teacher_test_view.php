<?php
session_start();




//This file shows all the previous test of a particular teacher and a
//particular subject code. Display all previous exams as well as newly
//created exams.





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
	echo '
	
		<html>
		<head>
			<title>View Tests</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
			      
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="template.css">
			
			<script>
				function func(x){
					window.location.href = "question_paper.php?test_id=" + x;
				}

				function submit(){
					window.location.href = "test-dashboard-create.php";
				}

			</script>
		</head>
		<body>
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
	
		<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
    <div class="container z-depth-5 blue-grey darken-4">
      <br><br>
      <h1 class="header center cyan-text">View All Exams</h1>
    <div class="container">
      <div class = "row col-lg-12">
         <div class = "col s12 m12 l12">
            <div class = "card-panel ">
               <div class = "card-content" >
                  
	<table class="highlight centered highlight">
        <thead>
          <tr>
			  <th> Test Id </th>
              <th>UG/PG</th>
              <th>Sub Code</th>
              <th>Paper Name</th>
              <th>Instructor</th>
              <th> Edit </th>
          </tr> 
        </thead>

        <tbody font="Helvetica">
		';
		
		
		
		
		
		
		
		for($ct=1 ;$ct<=10 ; $ct++){
		
        echo '  <tr>
					<td>';
					
					//please put test id here........
					echo '1234';
					
					
					echo '</td>
					<td>';
					
					
					//Please put UG or PG here.........
					echo 'UG';
					
					
					echo '</td>
					<td>';
					
					
					//Please put subject code here...........
					echo 'CS503';
					
					
					
					echo '</td>
					<td>';
					
					
					//Please put paper name here........
					echo 'ENGINEERING CLASS';
					
					
					echo '</td>
					<td>';

					//plase put teachers name here............
					echo 'A,H ghosh';
					
					
					echo '</td>
					<td><button class="btn-floating btn-small waves-effect pulse waves-light red" onclick="func(';
					
					
					//Please put test id here......
					echo '5';
					
					
					
					echo ')"><i class="material-icons">edit</i></button>
				</tr>
		';
		
		
		}
		
        echo '</tbody>
      </table>
    <button class="btn waves-effect waves-light" onclick="submit()" >Add New Test
    <i class="material-icons right">create</i>
	</button>
               </div>
               </div>
               
               

		

	</body>
	</html>

';

}

?>