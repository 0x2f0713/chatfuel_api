<?php
// Tạo dữ liệu gửi đi
function postdata($url)
{
	$postdata = json_encode(array('retina' => true, 'url' => $url));
	return $postdata;
}
// Lấy ảnh từ server urlbox.io
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

// MAIN

// Biểu thức REGEX
$boolean = "/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/";

// Tạo URL ảnh
$image = (isset($_GET[url]) == TRUE && preg_match($boolean, $_GET[url]) == 1 ) ? get_image(postdata($_GET[url])): "https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/ruoEhTkNeiwq2lefr/page-not-found-error-404-abstract-network-moving-background-red-bloody-dots-connected-by-lines-on-dark-background-white-number-404-available-in-hd-video-animation-footage-seamless-loop-animation_breo1yebel_thumbnail-full01.png";

// Tạo chuỗi tin nhắn
$reply = array(
	"messages" => array(
		0 => array(
			"attachment" => array(
				"type" => "image",
				"payload" => array(
					"url" => $image
				)
			)
		)
	)
);

// Encode mảng thành JSON rồi in kết quả
echo json_encode($reply);
 ?>
