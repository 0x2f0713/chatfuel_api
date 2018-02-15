<?php

$url = @$_POST['url'];
if(!$url) $url = @$_GET['url'];
    $rep  = array(
        'messages' => array(
            0 => array(
              'text' => 'Ảnh chụp của ' . $url
            ),
            1 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => 'https://apileap.com/api/screenshot/v1/urltoimage?access_key=54d50bcd27374a0da7321a69318c8e9d&url='.$url.'&fresh=true&width=1920&height=1080'
                    )
                )
            ),
        )    
    );
  echo json_encode($rep);
