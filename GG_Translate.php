<?php
$req = $_GET['q'];
$fp = file_get_contents_curl('https://translate.googleapis.com/translate_a/single?client=gtx&sl='.$_GET['src_lang'].'&tl='.$_GET['tar_lang'].'&dt=t&q='.urlencode($_GET['q']),5 );

# Hàm mình tham khảo trên GitHub: https://gist.github.com/jrivero/5598138 .
function file_get_contents_curl($url, $retries=5)
{
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // The number of seconds to wait while trying to connect.
        curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // The maximum number of redirects
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
# Convert dữ liệu xâu thành mảng.
    $data = (array) json_decode($fp);
# Mảng chứa tên ngôn ngữ.
    $lang = array(
        'af' => 'Afrikaans',
        'ga' => 'Ireland',
        'sq' => 'Albania',
        'it' => 'Italia',
        'ar' => 'Ả Rập',
        'ja' => 'Nhật',
        'az' => 'Azerbaijan',
        'kn' => 'Kannada',
        'eu' => 'Basque',
        'ko' => 'Hàn',
        'bn' => 'Bengal',
        'la' => 'Latinh',
        'be' => 'Belarus',
        'lv' => 'Latvia',
        'bg' => 'Bulgaria',
        'lt' => 'Litva',
        'ca' => 'Catalan',
        'mk' => 'Macedonia',
        'zh-CN' => 'Hán giản thể',
        'ms' => 'Malaysia',
        'zh-TW' => 'Hán phồn thể',
        'mt' => 'Maltese',
        'hr' => 'Croatia',
        'no' => 'Norwegian',
        'cs' => 'Séc',
        'fa' => 'Iran',
        'da' => 'Đan Mạch',
        'pl' => 'Ba Lan',
        'nl' => 'Hà Lan',
        'pt' => 'Portuguese',
        'en' => 'Anh',
        'ro' => 'Romani',
        'eo' => 'Esperanto',
        'ru' => 'Nga',
        'et' => 'Estonia',
        'sr' => 'Serbian',
        'tl' => 'Filipino',
        'sk' => 'Slovakia',
        'fi' => 'Phần Lan',
        'sl' => 'Slovenia',
        'fr' => 'Pháp',
        'es' => 'Tây Ban Nha',
        'gl' => 'Galicia',
        'sw' => 'Swahili',
        'ka' => 'Georgian',
        'sv' => 'Thụy Điển',
        'de' => 'Đức',
        'ta' => 'Tamil',
        'el' => 'Hy Lạp',
        'te' => 'Telugu',
        'gu' => 'Gujarati',
        'th' => 'Thái',
        'ht' => 'Haitian Creole',
        'tr' => 'Thổ Nhĩ Kỳ',
        'iw' => 'Hebrew',
        'uk' => 'Ukraina',
        'hi' => 'Hindi',
        'ur' => 'Urdu',
        'hu' => 'Hungary',
        'vi' => 'Việt',
        'is' => 'Iceland',
        'cy' => 'Welsh',
        'id' => 'Indonesia',
        'yi' => 'Yiddish',
);
# Đếm số câu.
    $text = '';
    $count = 0;
    for ($i=0; $i <= strlen($req); $i++) { 
            if (($req[$i] == '.' or $req[$i] == '!' or $req[$i] == '?') && $req[$i+1] == ' ') {
            $count = $count + 1;
        }
    }
    $count = $count +1;
# Tạo chuỗi kết quả.
    for ($i=0; $i <= $count; $i++) { 
        $text = $text.$data[0][$i][0];
    }
# Tạo đoạn tin nhắn.
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => 'Bot đang dịch nè. Đợi một nốt nhạc thôi. <3'
            ),
            1 => array(
                'text' => '*Bản dịch:* ' .$text
            ),
            2 => array(
                'text' => 'Số câu: '.$count
            ),
            3 => array(
                'text' => 'Ngôn ngữ của văn bản gốc: Tiếng '.$lang[$data[2]]
            )
        ),
);
    echo json_encode($reply);
?>