<?php

define("key","topSecret");
define("timeOut","1800");

define("location","http://gcectonlineexam.scientificvoyage.net/update1/api/");
$url = location;

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
