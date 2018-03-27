<?php

$url = @$_GET['page_url'];
if(!$url) $url = @$_POST['page_url'];
$post = 'url='.$url;
$curl = 'http://api.rest7.com/v1/youtube_thumbnail.php';

$ch = curl_init($curl);
curl_setopt($ch, CURLOPT_URL, 'http://api.rest7.com/v1/youtube_thumbnail.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$json = curl_exec($ch);
 curl_close($ch);
$text = json_decode($json, true);
    $rep  = array(
        'messages' => array(
            0 => array(
              'text' => 'Ảnh thu nhỏ của ' . $url
            ),
            1 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text['thumb_url']
                    )
                )
            ),
            2 => array(
                'text' => 'Kích thước ' . $text[thumb_width] . ' x ' . $text[thumb_height]
            ),
            3 => array('text' => 'Link ảnh gốc: '.$text['thumb_url'] )
        )
    );
  echo json_encode($rep);
