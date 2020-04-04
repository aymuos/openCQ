<?php
session_start();
if ( isset($_SESSION['loggedin']) == false ){
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
<p class="text-center">Please <a href="smain.html">Login</a> first</p>
</div>
</div>
</body>
</html>


';
}
else {
	
	
	$n = 10;

	echo '





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="workpgcuss.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<title> Your Workspace </title>
<script>document.createElement("top_res")</script>


<script type="text/javascript">

	



	function saveFunc(){
		var str = "save-opt.php?";
		for( var j = 1 ; j <= '.$n.' ; j++ ){
			var id = document.getElementsByName(\'quesid\'+j);
			str = str + "quesid" + j + "=" + encodeURIComponent(id[0].value) +"&";
			var radios = document.getElementsByName(\'question\'+j);
			var temp = "0";
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {
					temp = i+1 ;
					break;
				}
			}
			str = str + "ques" + j + "=" + temp + "&";
		}
		window.location.href = str + "submit=0";
	}
	
	
	
	
	function submitFunc(){
		var str = "save-opt.php?";
		for( var j = 1 ; j <= '.$n.' ; j++ ){
			var id = document.getElementsByName(\'quesid\'+j);
			str = str + "quesid" + j + "=" + encodeURIComponent(id[0].value) +"&";
			var radios = document.getElementsByName(\'question\'+j);
			var temp = "0";
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {
					temp = i+1 ;
					break;
				}
			}
			str = str + "ques" + j + "=" + temp + "&";
		}
		window.location.href = str + "submit=1";
	}
	
	
	
	


</script>


</head>


<body>
	<h2> GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY , KOLKATA
</h2>
<top_res>Welcome to Online MCQ test Platform</top_res>
 
<h1 class="hi"> ATTEMPT THE FOLLOWING QUESTIONS </h1>

';


//Do not do anything
if(isset($_GET["xYreT"])){
echo '
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Answer successfully <strong>saved!</strong>
</div>
';
}

echo '<div id="form_wrapper">';


	$ct=1;	//Do not delete this variable....
	
	
	//This loop prints 10 question along with its answer
	for($i = 1 ; $i <= $n ; $i++){
		//Do not do anything
		echo '<div class="w3-panel w3-border w3-round-xlarge option_cont"> <p class="experiment"><b>Question '.$ct.' :</b></p><br><input name="quesid'.$ct.'" type="text" value="';
		
		
		
		//Please put the question id of the i th question in this echo statement..............
		echo 'ques_id';
		
		
		//Do not do anything
		echo '" disabled hidden><textarea class="box" type="text" placeholder=" Problem Statement......" name="problem-statement" disabled>';
		
		
		
		
		//Put the question ststement in this echo statement.
		echo 'Problem ststement';
		
		
		
		
		
		
		
		//Do not do anything
		echo '</textarea><br><br>';
		
		
		echo '<img id="img_disp" class="image_class" src="';
		
		
		//If image is present then put the url here...........else don't print anything
		echo 'https://i.imgur.com/9OQ7z99.jpg';
		
		
		
		
		
		echo '">';
		
		
		
		
		
		
		
		
		
		echo '<form id="form'.$ct.'"><input type="radio" name="question'.$ct.'" value="'; 
				
				
				
				
		//Please put option 1 here......
		echo 'option 1';
				


				
				
		//If option 1 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo '" checked >';
		}
		else{
			echo '" >';
		}

		
				
		//please put option 1 here again......It is not a mistake.
		echo 'option 1';

				

				
				
		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
				
				
		

		
		//Please put option 2 here......
		echo 'option 2';
		
				
				
		//If option 2 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				

		//please put option 2 here again......It is not a mistake.
		echo 'option 2';
		
		
		
				
				
		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
				
				
				
			
		//Please put option 3 here......
		echo 'option 3';
		
				
				
				
				
				
		//If option 3 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				
				
				
				
				
			
		//please put option 3 here again......It is not a mistake.
		echo 'option 3';
		
				
		

		//Do not do anything
		echo '<br><input type="radio" name="question'.$ct.'" value="';
		
		
		
		
		//please put option 4 here.
		echo 'option 4';
		
				
				
		//If option 4 has to be marked then please put a condition in the if statement that is true.
		if( $ct == 0){
			echo '" checked >';
		}
		else{
			echo '" >';
		}
				
				
		
		
		
		//please put option 4 here again......It is not a mistake.
		echo 'option 4';
		
				
				
				
				
		//Do not do anything
		echo '<br></form></div>';
		
		$ct = $ct + 1 ;

	}






echo '



</div>

<div class="drama">

<button class="button btn-success" onclick="saveFunc()">Save</button>
<button class="button btn-danger" onclick="submitFunc()">Submit</button>
</div>

</body>
</html>



';
echo'
<p class="footer">
OpenCQ test platform by Rashed Mehdi,Rishav Banerjee,Saranya Naha Roy,Soumya Mukherjee</p>
';
}

?>