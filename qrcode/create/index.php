<?php
    $rep  = array(
        'messages' => array(
            0 => array(
                'attachment' => array(
                    'type' => 'image',
                    'payload' => array(
                        'url' => 'http://api.qrserver.com/v1/create-qr-code/?data='.urlencode($_GET[text]).'&size=1000x1000'
                    )
                )
            )
        ),
    );
  echo json_encode($rep);
