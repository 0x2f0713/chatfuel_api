<?php

$googleapikey = "AIzaSyBxApso1lWf0JDnRvp4Sq8xdEvNARc9dpU";
$longurl = $_GET['link'];


$data = array(
        "longUrl" =>$longurl
);

$data_string = json_encode($data);

$curl = curl_init(
    'https://www.googleapis.com/urlshortener/v1/url?key='.$googleapikey);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string),
        'referer: https://www.namhaiit.ml') #Hàm strlen() sẽ lấy chiều dài của chuỗi bao gồm cả các khoảng trắng ở đầu và cuối chuỗi. Hàm trả về kết quả số nguyên là chiều dài của chuỗi truyền vào.
);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);

$shorkey = json_decode($result);
$rep  = array(
    'messages' => array(
        0 => array(
          'text' => 'Link rút gọn: ' . $shorkey->id
        )
    )
);
echo json_encode($rep);
 ?>
