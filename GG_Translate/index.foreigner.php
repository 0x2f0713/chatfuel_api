<?php 
$data = file_get_contents_curl('http://translate.googleapis.com/translate_a/single?client=gtx&sl='.$_GET['src_lang'].'&tl='.$_GET['tar_lang'].'&dt=t&q='.urlencode($_GET['q']),5 );
function file_get_contents_curl($url, $retries=5)
{
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
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
    $data = (array) json_decode($data);
    $lang = array(
        'af' => 'Afrikaans',
        'ga' => 'Ireland',
        'sq' => 'Albania',
        'it' => 'Italia',
        'ar' => 'Arabic',
        'ja' => 'Japanese',
        'az' => 'Azerbaijan',
        'kn' => 'Kannada',
        'eu' => 'Basque',
        'ko' => 'Korean',
        'bn' => 'Bengal',
        'la' => 'Latin',
        'be' => 'Belarus',
        'lv' => 'Latvia',
        'bg' => 'Bulgaria',
        'lt' => 'Litva',
        'ca' => 'Catalan',
        'mk' => 'Macedonia',
        'zh-CN' => 'Chinese Simplified',
        'ms' => 'Malaysia',
        'zh-TW' => 'Chinese Traditional',
        'mt' => 'Maltese',
        'hr' => 'Croatia',
        'no' => 'Norwegian',
        'cs' => 'Czech',
        'fa' => 'Iran',
        'da' => 'Danish',
        'pl' => 'Polish',
        'nl' => 'Dutch',
        'pt' => 'Portuguese',
        'en' => 'English',
        'ro' => 'Romani',
        'eo' => 'Esperanto',
        'ru' => 'Russian',
        'et' => 'Estonia',
        'sr' => 'Serbian',
        'tl' => 'Filipino',
        'sk' => 'Slovakia',
        'fi' => 'Finnish',
        'sl' => 'Slovenia',
        'fr' => 'French',
        'es' => 'Spanish',
        'gl' => 'Galicia',
        'sw' => 'Swahili',
        'ka' => 'Georgian',
        'sv' => 'Swedish',
        'de' => 'German',
        'ta' => 'Tamil',
        'el' => 'Greek',
        'te' => 'Telugu',
        'gu' => 'Gujarati',
        'th' => 'Thai',
        'ht' => 'Haitian Creole',
        'tr' => 'Turkish',
        'iw' => 'Hebrew',
        'uk' => 'Ukraina',
        'hi' => 'Hindi',
        'ur' => 'Urdu',
        'hu' => 'Hungary',
        'vi' => 'Vietnamese',
        'is' => 'Iceland',
        'cy' => 'Welsh',
        'id' => 'Indonesia',
        'yi' => 'Yiddish',
);
    $text = '';
    foreach ($data[0] as $key => $value) {
        $text .= $value[0];
    }
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => 'Your task is processing'
            ),
            1 => array(
                'text' => '*Translation:* ' .$text
            ),
            2 => array(
                'text' => 'The original language is '.$lang[$data[2]]
            )
        ),
);
    echo json_encode($reply);
