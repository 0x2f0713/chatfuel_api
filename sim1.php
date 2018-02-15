 <?php
  header('Content-Type: text/html; charset=utf-8');
  $type = $_GET[type];
  $msg  = $_GET[msg];
  $key = '51b2b683-7c95-4a93-a088-127d103bdee2'; #Key của bạn, thay key vào đây.
  $json = file_get_contents('http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=vi&ft=1.0&text=' . urlencode($msg));
  $text = json_decode($json, true);
  if ($type != 'voice') {
      $rep  = array(
          'messages' => array(
              0 => array(
                  'text' => $text['response']
              )
          )
      );
  } else {
      $url  = 'http://translate.google.com/translate_tts?ie=UTF-8&total=1&idx=0&textlen=text.length&client=tw-ob&q=' . urlencode($text['response']) . '&tl=vi';
      $rep  = array(
          'messages' => array(
              0 => array(
                  'attachment' => array(
                      'type' => 'audio',
                      'payload' => array(
                          'url' => $url
                      )
                  )
              )
          )
      );
  }
  echo json_encode($rep);
 ?>