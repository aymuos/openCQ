<?php
session_start();

//This is the main test page........Please proceed as commented


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
	echo '
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<title>Test Page</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="scrimba.js"></script>
		<link rel="stylesheet" type="text/css" href="scrimbacss1.css">

	</head>
	<body onload="setInterval(onTimerElapsed, 1000);">
	
	
	<input id="no_ques" type="text" value="';
	
	
	//Put the total no of questions here.............
	echo '3';
	
	
	
	echo '" readonly hidden>
	

	<div id="initial-head">
	<nav>
		<div class="nav-wrapper orange accent-3 z-depth-4">
			<a class="brand-logo center ">OpenCQ test Platform</a>
			<div class="tlogo" style=" ">
				<img class="logo" src="logo256.png" width="100%" alt="Avatar"></img>  
			</div>		
		</div>
	</nav>
	</div>
	
	

	
		<div id="initial_message" class="initial">
			<label class="class-label time" style="font-size: 30;">You have to go Full Screen mode Immediately.</label><br><br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		
		
		
		
		
		
		
		<div id="exam_page" style="display: none;">
			<nav>
				<div class="nav-wrapper orange accent-3 z-depth-4">
					<a href="#" class="brand-logo center ">OpenCQ test Platform</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li> <a class="waves-effect waves-light btn grey darken-4" onclick="submit_paper()">
					SUBMIT <i class="material-icons right">navigate_next</i></a></li>
					</ul>
					<div class="tlogo" style=" ">
						<img class="logo" src="logo256.png" width="100%" alt="Avatar"></img>  
					</div>		
				</div>
			</nav>
			<div class="div-timer">
        <label class="class-label class1">Name : </label><label class="class-label time">';
		
		
		//Put the students name here............
		echo 'Rashed Mehdi';
		
		
		
		echo '</label>
        <label class="class-label class2">Roll No : </label><label class="class-label time">';
		
		
		
		//Put the Students Roll no here.............
		echo 'GCECTB-R17-3018';
		
		
		
		echo '</label>
        <label class="class-label class3">Time Elapsed : </label><label class="class-label time">
				<label id="hrs" class="class-label time">';
				
				
				//Put the number of hours elasped here............
				echo '00';
				
				
				
				echo '</label> : 
				<label id="mins" class="class-label time">';
				
				
				
				//Put the no of minutes elasped here...........
				echo '59';
				
				
				
				echo '</label> : 
				<label id="secs" class="class-label time">';
				
				
				//Put the no of secs elasped here..........
				echo '55';
				
				
				echo '</label>
			</label>
    </div>
		
<div class="col s12 m6 l4">
	<div class="card" >
		<div class="card-tabs">
			<ul class="tabs tabs-fixed-width">';
			
			
			
			$len = 3;		//Put the total no of question here........
			
			
			//Please donot do anything within this for loop.
			for($i=1;$i<=$len;$i++){
				echo '<li class="tab" id="tab'.$i.'"';
				if($i==1)
				echo 'style="background-color: #ffd699;"';
				echo '>
					<a id="htab'.$i.'" href="#test'.$i.'" class="active" onclick="color_tab(\''.$i.'\')" style="color: #cc5200;"><b>Question '.$i.'</b></a></li>
					';			
			}
			echo '
			</ul>
		</div>';
		
		
		
		
		$ct = 1;	//Donot delete this variable..............
	
	
		for($i=1;$i<=3;$i++){
			
			
			echo '
	
	<div id="test'.$ct.'">
		<div class="card-content">
			<div><b>Question '.$ct.' :</b></div>
			<input id="ques_id1" type="text" value="';
			
			
			
			//put the question id here...........
			echo '123';
			
			
			
			
			echo '" readonly hidden>
			<blockquote><p>';
			
			
			
			//Put the question statement here............
			echo '
			This is a written question number 1 given by the teacher which is within the text box.
			This is for test purpose only. This may increase in length see test whether it passes the test for a given
			length. Some text is here written.';
			
			
			
			
			echo '
			</p></blockquote>
			<img  src="';
			
			
			//Put the image location/url here............if there is no image or url then print nothing.....
			echo 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAogAAABRCAYAAABR51d0AAAgAElEQVR4Ae3dCbytU/kHcEk0SIOxjJFIMheFhEpIkZIQMg9pMCZCmZUpVDKVKVPGyhQyz/MQmSKZqQyZyvrf7/vpOf913rv3me49957TfZ7P55y9z97rXcNvPcNvPWu975mspCQCiUAikAgkAolAIpAIJAIVApNV7/NtIpAIJAKJQCKQCCQCiUAiUJIgphIkAolAIpAIJAKJQCKQCPRCIAliLzjyj0QgEUgEEoFEIBFIBBKBJIipA4lAIpAIJAKJQCKQCCQCvRBIgtgLjvwjEUgEEoFEIBFIBBKBRCAJYupAIpAIJAKJQCKQCCQCiUAvBJIg9oIj/0gEEoFEIBFIBBKBRCARSIKYOpAIJAKJQCKQCCQCiUAi0AuBJIi94Mg/EoFEIBFIBBKBRCARSASSIKYOJAKJQCKQCCQCiUAikAj0QiAJYi848o9EIBFIBBKBRCARSAQSgWEjiH//+9/LPvvsUzbaaKPy5JNP9on0nnvuWVZbbbVy00039Vmu25ePPfZYWX311ctOO+1UXnjhhW7F8vMxCJxxxhnlC1/4QvM6EgC55JJLyhprrFF+97vflddff30kdGnE9uFPf/pT+drXvlb233//8o9//GPE9vNf//pXY49LL710+cQnPlEuuOCC8p///GfE9rfu2GuvvVZ+8YtflC9+8Yvl/vvvr7+aoO8vvfTSstZaa5Vf/vKXE7TdbGz8InD55ZeXtddeuxx11FHjt+JRXNvhhx/e+Ic//vGPo3gUI6Pr//znP8tWW21Vdt1113551lB6PGiC+KMf/agstdRSzY8A8JnPfKassMIKTSCIz7fbbrty7733ls9//vNlxhlnLH/5y1/67NsyyyxTJptssnLWWWf1Wa7bl/fcc09z/YILLlieeeaZbsXy8zEI/OAHP2iw2m233UYEHsccc0zTn4MOOigJYj8zwqGyk5VXXrlYFI1EsTDceuuty3TTTVcOPfTQcsIJJ5QHH3xw1MztK6+8UjbbbLMG5xtuuGG8Q/y3v/2trL/++uXTn/504T/5TK98Zj2nxx57bJlqqqnKt7/97fHeh6xwwiFw/PHHlze/+c3lG9/4xoRrdIS3tO666zb2dcQRR4zwno787km+zTXXXA3/4mfHtwyaIF577bWF0vv56U9/2nRupplmKvvtt1/P57JCDz/8cFlzzTXL3HPP3bzvq+Myh+edd1556qmn+irW9bsXX3yxnH/++eW6664rr776atdyk8oX//73v8tvf/vb8tWvfrVcddVVvYZNic4999zywAMP9Pp8uP9AFGR5L7vssl5N+fyd73xn+dnPfjZeSAQSJUM61MVGr84Nwx9IE7sYSrYc+brooovKrbfeWhCZkSgPPfRQmW+++ZpM50jsX399gut3vvOd8ra3va3cfPPN/RUf9Pd33XVXecc73lE+8pGPNDrPj/74xz9u/OTyyy/fzK1KTzrppDLDDDOUHXfccdBt5AUTHgE7IPzOhRde2KvxU045pUmSWABMamLRbzF0yy239Bo6GxCvLZZSxg0BnGnhhRcuK620UuF7x7cMmiDWHUBEZAltI7W3kR9//PHyla98pbz//e8vjzzySH1Zvp8ACCDvMhBnn332BGit/yakwGW/fvOb3/QqHATx5z//ea/Ph/rHySef3LRz8MEHD7WKYb3OkYspp5yyXHzxxcPazsSq/NFHH20CoiziaJThJoh33313mW222coWW2zRa9v9kEMOKW95y1vK7rvv3sCGWCRBHD0aZIHLv7WPBPBHdtEmRYLoOMy73vWusZICo2dWR35Pn3766R6C2N9O7VBGM04EUedWXHHF8vGPf7zZUq47YLvE2bKFFlqo3H777c05DNsptqRPO+20umhz5sd5mxtvvLHn89NPP70su+yyzRaMLTUZsW6CRW+++eZll112Kc8//3xPsW9+85s92ziyAv0xbNmZ2Ca37bPeeusN6KzXOeec0zB4137pS19qsjwIz7bbbttzPaLGYOqshGCEICHSt912W0+/vUFwEG91LjNmC/7Xv/51r+9feumlcthhh/WML/oK9y9/+ctNZvdNb3pT+eAHP9jUISA98cQTTZZVe22ids011zQZvhi/eXVeMURf9WHjjTcu9913X4O3svooeyyL20msFm3ZCYpvfOMbyzzzzNP0x7kJY1Dn9NNP32SjbavFnGunnkt1P/fcc+Vb3/pWzxwtt9xy5dRTT22a/etf/1p22GGHpv43vOENZc4552zKGSvS0k1+//vfNyv/GPf3v//9YnET4sgCvYrvjXf77bePr5vXO++8s9g2kQW3Ze7IhfLmIXTOdqUysu3m5UMf+lBTxrlZ596I7Gq0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ryy33HLl5JNPLt///vfLEkssUQ455JCBNj+ocldeeWXZZZddyu9+97ue6xDcgw46qKy//vrlb3/7W8/nE+rNPffcU7bZZpty+eWX92ryhRdeaIj3D3/4w/LUU0/1+i7/SAQSgdGJQBLE0Tlv2etEYKIg8NJLL5UDDjigLL300k3W7VOf+lQ55phjevUFWdhss83KvPPOW+68885e3/X3xyOPPFJWXXXVpu4nn3yyv+JD+t4YfvCDHzTkT/+ffvrpser5z3/+U773ve+Vt7zlLQVB1K+//OUvZZlllimrr756Q4JuueWWstFGG5Vf/epXY10/Lh/8/e9/Lwiqdk455ZRy//3391R39913l7nmmqvMMMMM5R//+EfP58P9Rh+23HLL8sEPfrC84Q1vKGeccUavJl999dVyzTXXlB122KGss8465bTTTuv1ff6RCCQCow+BJIijb86yx4nAREHgoYceKptsskmTNTv44IObjNtee+1V1lxzzfL73/++p0+I0xxzzFF22223gowNVn7xi1+UWWaZpSFHg712oOWNxRazLKL+v/zyy2NdKps53XTTlV133bX5zrbypz/96Z7s5s9+9rNmy/muu+4a69qhfqAf3/rWtxqCfNFFF41VzXPPPVcuvvjictVVV431XX8fnHXWWWX33Xcvf/rTn/or2vP9a6+91myn77fffk0Gdb311itvetObym9/+9ueMvWbxx57rMmsWkDUOlGXyfeJQCIwOhBIgjg65il7mQhMdASOPvro8s53vrPJbtWdcQYvslz//ve/y7HHHlumnXbacsEFF9TFBvz+tttua7ZxZSGHU2zhzj333GWKKaYoiG5bjOXSSy8t9957b/OVrCMyGYQQWVprrbXKjTfeOOSxtts86qijyvzzz19gPb4FyZMxbW8P99WOTCoyLRP8+uuvN1vr73jHO8qZZ57Z9TKZzbXXXrssueSSTda1a8H8IhFIBEY0AkkQR/T0ZOcSgZGDwL777ttk3A488MCunXrmmWcaEvWBD3ygPPzwwz3lHnjggeKGDpknZwBXXHHFJkuGcDmvWIut5a997Wtl0UUXbbZ26+/G53vkx/a4LOJ73vOe8oc//KFr9ciRrJgxRLZRNvXtb3972W677cbLjSrOFLphxrnIF198sVdfYLLnnnuWz3zmM2WDDTYof/7zn3t9P5A/ZH1t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';
			
			
			echo '">
     
			
			
			<br><br>
			
			<p><label><input class="with-gap" type="radio" value="';
			
			
			
			//Put the option1 id here........
			echo '11';
			
			
			
			echo '" name="option1"/><span>';
			
			
			
			//Put the option1 name here............
			echo 'Red';
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			//Put the option2 id here........
			echo '12';
			
			
			echo '" name="option1"/><span>';
			
			
			
			//Put the option2 name here............
			echo 'Yellow';
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			
			//Put the option 3 id here............
			echo '13';
			
			
			
			echo '" name="option1"/><span>';
			
			
			
			//Put the option3 name here............
			echo 'Filled in';
			
			
			
			echo '</span></label></p>
            <p><label><input class="with-gap" type="radio" value="';
			
			
			
			
			//Put  the option 4 id here............
			echo '14';
			
			
			
			echo '" name="option1" /><span>';
			
			
			
			//Put  the option 3 name here............
			echo 'Indeterminate Style';
			
			
			
			echo '</span></label></p>
				
			<br>
			
			
			<div id="trt'.$ct.'" class="ack green" style=""></div>
			
			<br>
			
			<div class="container">
				<div class="button-properties">
					<button class="btn waves-effect waves-light" type="button" onclick="save_opt(\''.$ct.'\',\'';
					
					
					
					//Put the question id here again............
					echo '123';
					
					
					
					
					echo '\')">Save
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
				
				
		</div>  

	</div>';
	
	
	
			$ct+=1;
	
		}
	
	
	
	
	
			echo '</div>
			</div>
		</div>

		
		<div id="warning_message" class="initial" style="display: none;">
			<label class="class-label time" style="font-size: 30;">Please return to the Full Screen mode within </label><label class="class-label time" id="time" style="color: red;font-size: 30;">6</label><label class="class-label time" style="font-size: 30;"> secs.</label><br>
			<br>
			<button type="button" class="btn orange free" onclick="openFullscreen()">Go Full Screen</button>
		</div>
		
		<div id="final_message" class="initial" style="display: none;margin-bottom: 240px;">
			<label class="class-label time" style="font-size: 30;">Thankyou! Your response has been submitted.</label><br>
		</div>
		

		
		<footer class="page-footer  deep-purple darken-4" style="height: 45px;margin-top:auto;">
            <div class="container" style="margin-top: 0px;">
            © 2020 OpencQ by  aymuos , asarynal , rishUV and rash42
            </div>
		</footer>
		

		
	</body>
</html>	
		
		
		
		
';



}

?>	
		
		
		
		
		
		
