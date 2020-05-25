<?php
	include 'db_connection.php';
	include 'upload_functions_0.1.php';

	$chname = $_POST["chapter-name"]; 			//This is the chapter name
	$statement = $_POST["problem-statement"];	//This has the problem statement
	$co = $_POST["correct"];					//This is the correct option
	$ico1 = $_POST["incorrect1"];				//This is the incorrect option 1
	$ico2 = $_POST["incorrect2"];				//This is the incorrect option 2
	$ico3 = $_POST["incorrect3"];				//This is the incorrect option 2
	$var = $_POST["x"];							//if '$var' is 0 then it means that user has just uploaded the image...if 1 then user has finished the whole question.
	$id = $_POST["ques_id"];					//This contains the question id. if it is empty then it is a new question
	
	
	$conn = OpenCon();

	$flag = [];	
	
	
	//$id = "";

	if($var==1 && $_POST["clipboard_image"] == "" ){
		$query = "SELECT url FROM question WHERE id = ?";
		execute($conn,$query,"i",[$id],$stmt);
		$res = get_data($stmt);
		if(!$res){
			add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,[]);
		}
		else{
			add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,[$res[0]['url']]);
		}
	}

	//The image is uploaded as a file.......
	else if(basename($_FILES["fileToUpload"]["name"]) != ""){
		$flag[] = "uploads/";
		

		

		$new_image_name = "1";					//Please enter the new image name (without extension) ......
		$target_dir = "uploads/";				//Enter the folders name where all the image will be kept........
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		
		$flag[]=$imageFileType;
		
		$id = add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,$flag);
		$new_image_name = "$id";
		

		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}



		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				rename($target_file, $target_dir.$new_image_name.'.'.$imageFileType);
				$image_location = $target_dir.$new_image_name.'.'.$imageFileType;
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}

		//This variable contains the file location in the server...........store it in database
		//echo $image_location;


		


	}

	//The file has been sent by url
	else if($_POST["clipboard_image"] != "" ){
		$img_url = $_POST["clipboard_image"];		//Store this in the database........

		$flag = [$img_url];

		$id = add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,$flag);
	}

	/*else{
		$id = add_question($conn,$chname,$statement,$co,$ico1,$ico2,$ico3,$id,[]);
	}*/
	









//Image was uploaded
if($var == 0 ){
	
	//please put the question id here........
	$ques_id = $id;
	CloseCon($conn);
	header('location: add-a-ques.php?ques_id='.$ques_id.'&upld='.$target_dir.$new_image_name.'.'.$imageFileType);
}
else{
	//Whole question is uploaded
	//Redirects to "add-a-ques3.php"

	CloseCon($conn);
	header('location: add-a-ques3.php');

}





?>