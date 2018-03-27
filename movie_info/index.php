<?php

$title = @$_GET['title'];
if(!$title) $title = @$_POST['title'];
$post = 'title='.$title;
$curl = 'http://api.rest7.com/v1/movie_info.php';
$ch = curl_init($curl);
curl_setopt($ch, CURLOPT_URL, 'http://api.rest7.com/v1/movie_info.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$json = curl_exec($ch);
 curl_close($ch);
$text = json_decode($json, true);
        $rep  = array(
        'messages' => array(
            0 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text[movies][0][poster]
                    )
                )
            ),
            1 => array(
              'text' => 'Phim: ' . $text[movies][0][title]. '.' .' Đạo diễn:  '.$text[movies][0][director] . '.' .' Diễn viên:  '.$text[movies][0][cast] . '. ' . 'Năm sản xuất:  '.$text[movies][0][year]. '.'.' Thời gian: '. $text[movies][0][runtime]. 'phút.'.' Mã IMDB: '.$text[movies][0][imdb].'.'.' Ngôn ngữ: '.$text[movies][0][language]. '.'
            ),
            2 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text[movies][1][poster]
                    )
                )
            ),
            3 => array( 
                'text' => 'Phim: ' . $text[movies][1][title]. '.' .' Đạo diễn:  '.$text[movies][1][director] . '.' .' Diễn viên:  '.$text[movies][1][cast] . '. ' . 'Năm sản xuất:  '.$text[movies][1][year]. '.'.' Thời gian: '. $text[movies][1][runtime]. 'phút.'.' Mã IMDB: '.$text[movies][1][imdb].'.'.' Ngôn ngữ: '.$text[movies][1][language]. '.'
            ),
            4 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text[movies][2][poster]
                    )
                )
            ),
            5 => array(
                'text' => 'Phim: ' . $text[movies][2][title]. '.' .' Đạo diễn:  '.$text[movies][2][director] . '.' .' Diễn viên:  '.$text[movies][2][cast] . '. ' . 'Năm sản xuất:  '.$text[movies][2][year]. '.'.' Thời gian: '. $text[movies][2][runtime]. 'phút.'.' Mã IMDB: '.$text[movies][2][imdb].'.'.' Ngôn ngữ: '.$text[movies][2][language]. '.'
            ),
            6 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text[movies][3][poster]
                    )
                )
            ),
            7 => array(
                'text' => 'Phim: ' . $text[movies][3][title]. '.' .' Đạo diễn:  '.$text[movies][3][director] . '.' .' Diễn viên:  '.$text[movies][3][cast] . '. ' . 'Năm sản xuất:  '.$text[movies][3][year]. '.'.' Thời gian: '. $text[movies][3][runtime]. 'phút.'.' Mã IMDB: '.$text[movies][3][imdb].'.'.' Ngôn ngữ: '.$text[movies][3][language]. '.'
            ),
            8 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => $text[movies][4][poster]
                    )
                )
            ),
            9 => array(
                'text' => 'Phim: ' . $text[movies][4][title]. '.' .' Đạo diễn:  '.$text[movies][4][director] . '.' .' Diễn viên:  '.$text[movies][4][cast] . '. ' . 'Năm sản xuất:  '.$text[movies][4][year]. '.'.' Thời gian: '. $text[movies][4][runtime]. 'phút.'.' Mã IMDB: '.$text[movies][4][imdb].'.'.' Ngôn ngữ: '.$text[movies][4][language]. '.'
            )
        )
        );
echo json_encode($rep);