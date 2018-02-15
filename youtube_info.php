<?php

$url = @$_GET['page_url'];
if(!$url) $url = @$_POST['page_url'];
$post = 'url='.$url;
$curl = 'http://api.rest7.com/v1/youtube_info.php';
$thumbnail = '';
$ch = curl_init($curl);
curl_setopt($ch, CURLOPT_URL, 'http://api.rest7.com/v1/youtube_info.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$json = curl_exec($ch);
 curl_close($ch);
$text = json_decode($json, true);
$name_video=$text['title'];
$id_video =$text['id'];
$time_video =$text['duration'];
$giay ='giây';
if (array_key_exists(thumb5_url,$text) == true) {
    $thumbnail = $text[thumb5_url];
}
else {
    if (array_key_exists(thumb4_url,$text) == true) {
        $thumbnail = $text[$thumb4_url];
    } else {
        if (array_key_exists(thumb3_url,$text) == true) {
            $thumbnail = $text[thumb3_url];
        } else {
            if (array_key_exists(thumb2_url,$text) == true) {
                $thumbnail = $text[thumb2_url];
            } else {
                if (array_key_exists(thumb2_url,$text) == true) {
                    $thumbnail = $text[thumb2_url];
                } 
                else {
                    if (array_key_exists(thumb1_url,$text) == true) {
                        $thumbnail = $text[thumb1_url];
                    } else {
                        $thumbnail = 'https://i.ytimg.com/vi/R7o1PnHas9M/maxresdefault.jpg';
                        $name_video='Video không tồn tại';
                        $id_video ='ID không tồn tại';
                        $time_video ='Video không tồn tại nên không thể xác định thời gian';
                        $giay='';
                    }
                    
                }
            }
                
            }
            
        }
        
    }
    if ($text[duration] == null) {
        $time_video ='Video đang được xử lý hoặc không tồn tại hoặc là video live stream nên không thể xác định thời gian';
    } else {
        $time_video = $text[duration];
    }
    
    $rep  = array(
        'messages' => array(
            0 => array(
              'text' => 'Thông tin video YouTube có link là: ' . $url
            ),
            1 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $thumbnail
                    )
                )
            ),
            2 => array('text' => 'Ảnh thu nhỏ của video: '.$thumbnail ),
            3 => array(
                'text' => 'Tên video:  '.$name_video
            ),
            4 => array('text' => 'ID của video: '.$id_video ),
            5 => array('text' => 'Thời gian của video: '.$time_video.  $giay ),
        )
    );
  echo json_encode($rep);
