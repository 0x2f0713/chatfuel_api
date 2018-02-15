<?php

define('ACCESS_TOKEN', 'YOUR_ACCESS_TOKEN_HERE');

$data = json_decode(getData('https://graph.facebook.com/v2.11/YOUR_ID/photos?fields=images&limit=100&access_token=' . ACCESS_TOKEN));

$url = [];
foreach ($data->data as $value) {
	$url[] = array(
		'attachment' => array(
			'type' => 'image',
			'payload' => array(
				'url' => $value->images[0]->source
			)
		)
	);
}

$random = [];
for($i = 0; $i < 5; $i++) {
	$random[] = $url[array_rand($url)];
}

$result = array('messages' => $random);

echo json_encode($result);

function getData($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$curl = curl_exec($ch);
	curl_close($ch);

	return $curl;
}