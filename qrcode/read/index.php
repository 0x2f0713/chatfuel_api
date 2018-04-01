    <?php
    $rep = file_get_contents('http://api.qrserver.com/v1/read-qr-code/?fileurl='.urlencode($_GET[url]));
    $rep = json_decode($rep,true);
      if ($rep[0][symbol][0][error] == null) {
          $rep = array(
            'messages' => array(
                0 => array(
                    'text' => $rep[0][symbol][0][data]
                    ), 
                )
            );
      }
      else {
          $rep = array(
            'messages' => array(
                0 => array(
                    'text' => $rep[0][symbol][0][error]
                ), 
            )
        );
      }
    echo json_encode($rep);