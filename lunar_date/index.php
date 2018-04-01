<?php
require "simple_html_dom.php";
//Kiểm tra định dạng ngày tháng nhập vào
if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/",$_GET[date])) {
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => "Ngày tháng bị lỗi rồi bạn nhé"
            ), 
        )
    );
    $reply = json_encode($reply);
    exit($reply);
}
// Tạo mảng chứa ngày tháng năm
$ngay = explode("/",$_GET[date]);
// Lấy thông tin ngày âm lịch
$content = file_get_html("http://ngaydep.com/xem-ngay-$ngay[0]-thang-$ngay[1]-nam-$ngay[2].html");
// Xử lý ngày
preg_match("/[0-9]{0,}/",$content->find("div#ngayam",0)->plaintext, $ngayamlich);
// Xử lý tháng: bỏ kí tự đặc biệt "tab" khỏi chuỗi
$thangamlich = preg_replace('/[\t]/', '', $content->find('td.ngayduong',0)->plaintext);
// Tạo mảng tin nhắn
$reply = array(
    'messages' => array(
        0 => array(
            'text' => "Ngày " .$ngayamlich[0] . 
        ), 
    )
);
// Encode tin nhắn dưới dạng JSON
$reply = json_encode($reply);
// In ra JSON
echo $reply;