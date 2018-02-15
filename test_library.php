<?php
$link = "link=".$_GET['url']."&pass=undefined&hash=&captcha=";
$URL = 'https://linksvip.net/GetLinkFs';
# Hàm mình tham khảo trên GitHub: https://gist.github.com/jrivero/5598138 .
function file_get_contents_curl($url, $retries=5, $post)
{
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        #curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // The number of seconds to wait while trying to connect.
        #curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
        #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
        #curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
        #curl_setopt($ch, CURLOPT_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
        #curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // The maximum number of redirects
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: linksvip.net',
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Origin: https://linksvip.net',
    'X-Requested-With: XMLHttpRequest',
    'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'DNT: 1',
    'Referer: https://linksvip.net/',
    'Cookie: PHPSESSID=0lvmbgd0dqd2lv9tn5m5du5i54; __zlcmid=kgh4tqLkTPa1j8; user=win10.vn01%40gmail.com; pass=5458186f57705ea77db17feea4ff67f5'
    ));  #Tạo HTTP Header tùy chỉnh
        $result = curl_exec($ch);
        curl_close($ch);
    }
    else
    {
        $result = file_get_contents($url);
    }        
    if (empty($result) === true)
    {
        $result = false;
       if ($retries >= 1)
        {
            sleep(1);
            return file_get_contents_curl($url, --$retries);
        }
    }    
    return $result;
}

  $echo =(array) json_decode(file_get_contents(file_get_contents_curl($URL, 5, $link)), true);
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
  $data =file_get_contents_curl($URL, 5, $link);
  var_dump(json_decode($data),TRUE) ;
