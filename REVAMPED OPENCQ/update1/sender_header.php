<?php
define("key","SherlockNeedsWatson");


<<<<<<< HEAD
define("location","http://localhost:8080/update1/api/");
=======
define("location","http://localhost/update1/api/");
>>>>>>> 15af29ac9be395a8a33ca08e3554cea5942f6643


function send_post_request($url,$data,$content=0){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	if($content===1){
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	}
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function send_get_request($url,$data){
	$str = $url.'?';
	foreach($data as $key=>$val){
		$str = $str.$key."=".urlencode($val)."&";
	}
	// echo $str."\n";
	$str = rtrim($str,"&");
	$ch = curl_init( $str );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}



?>