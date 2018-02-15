<?php 
$url = $_GET['url'];
$post = array('retina' => true, 'url' => $url);
$header = array(
	'accept: application/json',
	'accept-encoding: gzip, deflate, br',
	'accept-language: vi,en;q=0.9,en-GB;q=0.8',
	'content-type: application/json',
	'cookie: __cfduid=d8a51730e32309562ad618a2f8bd2b5ad1517408515; machine-id=171.240.98.210%3A1517408519330; _ots=1.1517408519330.1517408519330.1517408519330; _otui=1584134254.1517408519330.1517408519330.1517408519330.1.1.0; _otpe=https%3A//urlbox.io/',
	'dnt: 1',
	'origin: https://urlbox.io',
	'referer: https://urlbox.io/',
	'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'
);
$ch = curl_init();
$data = json_encode($post);
curl_setopt($ch, CURLOPT_URL, 'https://urlbox.io/imageurl');
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
var_dump(json_decode($result),TRUE);
 ?>
<script src="https://urlbox.io/dist/main-1d3861e3a2d73b942f22.js"></script>