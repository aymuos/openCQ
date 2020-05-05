<?php
define("key","SherlockNeedsWatson");
define("url","localhost/update1/api/");
$url = url;




function send_post_request($url,$data){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
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
function cleanString($val)
    {
        $non_displayables = array(
        '/%0[0-8bcef]/',            # url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/',             # url encoded 16-31
        '/[\x00-\x08]/',            # 00-08
        '/\x0b/',                   # 11
        '/\x0c/',                   # 12
        '/[\x0e-\x1f]/',            # 14-31
        '/x7F/'                     # 127
        );
        foreach ($non_displayables as $regex)
        {
            $val = preg_replace($regex,'',$val);
        }
        $search  = array("\0","\r","\x1a","\t");
        return trim(str_replace($search,'',$val));
    }


?>