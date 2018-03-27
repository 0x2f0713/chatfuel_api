<?php
function postdata($url)
{
	$postdata = json_encode(array('retina' => true, 'url' => $url));
	return $postdata;
}
function get_image($postdata)
{
	$header = array(
	'Accept: application/json',
	'Content-type: application/json'
);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://urlbox.io/imageurl');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

	$page = curl_exec($ch);
	curl_close($ch);

	$info = json_decode($page);
	$url = $info->url;
	
	return $url;
}
$url = "https://gist.github.com/0x2f0713/4477473262a175c23805d8d6365089b8";
$postdata = postdata($url);
echo '<img src="'.get_image($postdata).'" >';
// unsave
 ?>
