<?php
include 'sender_header.php';




//This file sends a post/get request to the API and gets the json file.
//This acts as a front end script. This is only for testing the API.
//Put the url of the API file and the data in the send_post_request()/send_get_request() method.


 
$id=120;
$name="Tutorialswebsite";
$address="Sultanpur, New Delhi";
$phone=9999999999;
 
//API URL
$url="localhost/MCQN/api/login.php";
//Data
$data = array(	"key" => $key, 
				'username' => 'GCECTB-R17-3018',
				'password' => '',
				'category' => 2);

//Sending the post request. Returns a json file.
$result = send_post_request($url,$data);

//Printing the json file.
#echo $result;

//Sending Get request
//$result = send_get_request($url,$data);


echo $result;



?>