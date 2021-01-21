<?php

session_start();


if (!isset($_SESSION['loggedinteacher'])){
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
    <p class="text-center">Please <a href="teacher-login.html">Login</a> first</p>
    </div>
    </div>
    </body>
    </html>
    ';
    exit();
}
$username = isset($_SESSION['teachername'])?$_SESSION['teachername']:"X";
$code= isset($_SESSION['code'])?$_SESSION['code']:"X";
$subname = isset($_SESSION['paper'])?$_SESSION['paper']:"X";

?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Past Exams</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/brandinglogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="css/tdbhome.css">
  <link rel="stylesheet" href="css/teacher_test_dashboard.css">
    </head>

    <body>

    <!-- navbar code-->
    
  <nav>
    <div class="nav-wrapper gradient1">
        <a class="navbar-brand gibpadding " href="#">
            <img class="gibpadding2" src="img/logo256.png" height="60" alt="GCECT">
        </a>
      <a class="brand-logo" href="tdbhomeV2.php"><h5>   Teacher Userspace - Past Exam </h5></a>
      <ul class="right hide-on-med-and-down">
        
        <li><a href="logout.php" class="waves-effect waves-light btn gradient2">LOGOUT<i class="material-icons right">arrow_forward_ios</i></a></li>
      </ul>
    </div>
  </nav>

    
  <nav class="heightadjustnav2 z-depth-5">
    <div class="nav-wrapper gradient3">
      <div class="col s12 leftpad">
        <a href="teacher-login.html" class="breadcrumb">Login</a>
        <a href="tdbselectsubjectv1.php" class="breadcrumb">Select Subject</a>
        <a href="tdbhomeV2.php" class="breadcrumb">Teacher Dashboard</a>
        <a href="" class="breadcrumb">Past Exam</a>
      </div>
    </div>
  </nav>
            


            <div class="row">
    <div class="col s10 offset-s1">
      <div class="card leeftpad white z-depth-4">
        <span class="black-text">
        <div class="row">
        <div class="col s6">
        <p class= "leftpad" > <b>Teacher Name: </b><?php echo $username ?></p> <!--JS bring username from api-->
        </div>
        
        <div class="col s6">
         <p class= "leftpad"> <b>Selected Subject: </b><?php echo "$code ($subname)"?></p>
        </div>
        </div>
        
       
        </span>
      </div>
    </div>
  </div>


<!--stuff ends-->




<div class="container present-exam"> 
	<div class="heads purple">
		Past Exams
	</div>

     <table class="highlight centered">
        <thead>
          <tr>
              <th>Exam Id</th>
              <th>Subject Code</th>
			  <th>Batch</th>
			  <th>Stream</th>
			  <th>Description</th>
			  <th>Date Created</th>
			  <th>View Result</th>
			  <th>View Paper</th>
			  <th>Delete</th>
          </tr>
        </thead>

        <tbody>
<?php
	require('sender_header.php');
	$api = "exam.php";
	$username = $_SESSION['usernameteacher']; 
	$data = array(	"key" => key,
					"username" => $username,
					"examStatus" => '4',
					"examId" => 'ALL',
					"code" => $_SESSION['code'],
					"batchPassoutYear" => 'ALL',
					"stream" => 'ALL',
					"visible" => '1'
				);
	
	$result = send_get_request(location.$api,$data);
	$data = json_decode($result);
	if($data->status == "FAIL"){
		echo '</tbody></table><div style="text-align: center;">'.$data->comment.'</div>';
	}
	else{
		if(count($data->result) == 0){
			echo '</tbody></table><div style="text-align: center;">No Exam to display.</div>';
		}
		else{
			for($i=0;$i<count($data->result);$i++){
				echo "<tr><td>".$data->result[$i]->id."</td>";
				echo "<td>".$data->result[$i]->code."</td>";
				echo "<td>".($data->result[$i]->batchPassoutYear-4)." - ".($data->result[$i]->batchPassoutYear)."</td>";
				
				echo '<td>';
				for($j=0;$j<count($data->result[$i]->stream);$j++){
					echo $data->result[$i]->stream[$j];
					if($j+1 != count($data->result[$i]->stream))echo '&emsp;';
				}
				echo '</td>';
				echo '<td>'.$data->result[$i]->{'description'}.'</td>';
				$start = $data->result[$i]->{'created at'};
				$date = date('d/m/Y',$start);
				echo "<td>$date</td>";
				echo '<td><a class="btn-floating btn-small waves-effect pulse waves-light green" onclick="window.location.href=\'view_result.php?e='.($data->result[$i]->id).'\'"><i class="material-icons">assignment</i></a></td>
				<td><a class="btn-floating btn-small waves-effect pulse waves-light blue" onclick="view_test('.$data->result[$i]->id.')"><i class="material-icons">visibility</i></a></td>
			<td><a class="btn-floating btn-small waves-effect pulse waves-light red" onclick="delete_test('.$data->result[$i]->id.')"><i class="material-icons">delete</i></a></td></tr>';
			}
			echo '</tbody></table>';
		}
	}
?>



</div>


		<div class="col s12" style="text-align: center;margin-top: 60px;">
            <a href="tdbhomeV2.php" class="waves-effect waves-light btn btn-large red"><i class="material-icons left"></i>Back</a>
        </div>








  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Create Exam</h4>
	  <b>Enter the Details:</b><br>
		
		
		
		
		<div class="row" style="margin-top: 30px">
		<div class="input-field col s3" style="margin-top: 25px">
          Enter the Batch :
        </div>
        <div class="input-field col s3">
          <select id="join" class="browser-default" onchange="calculate()">
			<?php
			$year = date("Y"); 
			for($i=$year-5;$i<=$year;$i++)echo '<option value="'.$i.'">'.$i.'</option>';
		?>
		</select>
        </div>
		<div class="input-field col s1" style="margin-top: 25px">
          ---
        </div>
        <div class="input-field col s3">
          <input id="nxt" value="<?php echo date("Y")-1; ?>" class="white" type="text" readonly style="border-bottom: none;">
        </div>
      </div>
		
		
		
		
		
		
		<div class="row" style="margin-top: 15px">
		<div class="input-field col s3" style="margin-top: 25px">
          Enter the Stream :
        </div>
        <div class="input-field col s2">
          <label>
			<input type="checkbox" id="stream1"/>
				<span style="color: black">CSE</span>
			</label>
        </div>
		<div class="input-field col s2">
          <label>
			<input type="checkbox" id="stream2"/>
				<span style="color: black">IT</span>
			</label>
        </div>
		<div class="input-field col s2">
          <label>
			<input type="checkbox" id="stream3"/>
				<span style="color: black">CT</span>
			</label>
        </div>
      </div>
		
		
		
		
		
		
		
		
		<div class="row" style="margin-top: 15px">
		<div class="input-field col s4" style="margin-top: 25px">
          Enter the Description :
        </div>
        <div class="input-field col s8">
          <input type="text" id="desc">
        </div>
      </div>
		
		
		

	  
    </div>
    <div class="modal-footer" >
		<a class="waves-effect waves-green btn green" onclick="submit()">Add</a>
		<a href="#!" class="modal-close waves-effect waves-red btn red">Close</a>
    </div>
  </div>



  <div id="modal2" class="modal">
    <div class="modal-content" style="margin-top: 50px;text-align: center"><h5>Exam Created Successfully!</h5>
	</div>
    <div class="modal-footer" >
		<a class="waves-effect waves-green btn green" onclick="window.location.reload()">Ok</a>
    </div>
  </div>








            



      <!--JavaScript at end of body for optimized loading-->
      
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
		(function ($) {
			$(function () {
				//initialize all modals           
				$('.modal').modal();
				//or by click on trigger
				$('.trigger-modal').modal();
			}); // end of document ready
		})(jQuery); // end of jQuery name space
		$(document).ready(function(){
			$('select').formSelect();
		});
		

</script>
	  <script type="text/javascript" src="js/tdb2.js"></script>
	  <script type="text/javascript" src="js/teacher_test_dashboard.js"></script>
		<script>
			function view_test(id){
				window.location.href = "teacher_view_test.php?e="+id;
			}
		
		</script>
    </body>
  </html>