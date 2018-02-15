  <?php
  $link = $_GET['link'];
  $post = "link=".$link."&pass=undefined&hash=&captcha=";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://linksvip.net/GetLinkFs');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, ture);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: linksvip.net',
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Origin: https://linksvip.net',
    'X-Requested-With: XMLHttpRequest',
    'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'DNT: 1',
    'Referer: https://linksvip.net/',
    'Cookie: __cfduid=d4caae757dd449d8a3fdfaabddad0e48a1512302783; user=huynguyenvn.huynguyen%40gmail.com; pass=da54f18eb2c83e2df54abce273309123; __zlcmid=k0gyT6eoKkbPCg; PHPSESSID=5iunl3bebj0b76ag5je1pvlgt7; __atuvc=63%7C2%2C6%7C3'
    ));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  $json = curl_exec($ch);
  curl_close($ch);
  $echo = json_decode($json,true);
  $rep  = array(
      'messages' => array(
          0 => array(
            'text' => 'Link của bạn đã sẵn sàng để download'
          ),
          1 => array(
            'text' => 'Tên file: '.$echo['filename']
          ),
          2 => array (
              'text' => $echo['linkvip']
          ),
      )
  );
  echo json_encode($rep);
