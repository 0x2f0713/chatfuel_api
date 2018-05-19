<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_GET[url]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36");

$content = curl_exec($ch);
if (curl_errno($ch)) {
    $json = [
        "messages" => [
            0 => [
                "text" => "Error: Please report this bug by send the error code in the below to 0x2f0713@gmail.com",
            ],
            1 => [
                "text" => curl_error($ch),
            ],
        ],
    ];
    $json = json_encode($json);
    exit($json);
}
curl_close($ch);
preg_match("/https:\/\/drive\.google\.com\/viewerng.*proj/", $content, $link);
$content = str_replace("\\", "", html_entity_decode(preg_replace("/u([0-9a-f]{4})/", "&#x\\1;", $link[0]), ENT_NOQUOTES, 'UTF-8'));
$content = file_get_contents($content);
$content = json_decode(str_replace(")]}'", '', $content), true);
$json = [
    "messages" => [
        0 => [
            "text" => (array_key_exists('pdf', $content)) ? $content[pdf] : "We can not get document. Please report this bug to 0x2f0713@gmail.com.",
        ],
    ],
];
echo json_encode($json);
