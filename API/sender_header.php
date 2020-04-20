<?php
$key = "hJxBHbjbJBJUbdjkHldcsjbBVD";

function send_post_request($url,$data){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function send_get_request($url,$data){
	$str = $url.'?';
	foreach($data as $key=>$val){
		$str = $str.$key."=".urlencode($val)."&";
	}
	$str = rtrim($str,"&");
	$ch = curl_init( $str );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}



?>