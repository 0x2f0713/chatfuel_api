[![IMG](https://1.bp.blogspot.com/-KuniqJdoHqA/WoXO4i27vxI/AAAAAAAADGA/FNoK33Ioa441XwQnH260axi_BvCdbDUqgCLcBGAs/s640/og_chatfuel.jpg "IMG")](https://1.bp.blogspot.com/-KuniqJdoHqA/WoXO4i27vxI/AAAAAAAADGA/FNoK33Ioa441XwQnH260axi_BvCdbDUqgCLcBGAs/s1600/og_chatfuel.jpg)

Hôm nay là mùng 1 Tết của năm 2018, mình xin gửi tới các bạn những lời chúc tốt đẹp nhất, chúc các bạn có một năm mới tràn đầy niềm vui và hạnh phúc... và ăn ít bugs hơn. Vào việc chính nào! Mình sẽ chia sẻ source code API Google Dịch để sử dụng cho ChatFuel và những mục đích khác (nếu bạn có khả năng và ý tưởng).

### Mình lấy API này từ đâu?

Vào một ngày xấu trời, trong lúc đang bí ý tưởng về tính năng cho chatbot của mình, mình nảy ra ý tưởng dịch văn bản trên chatbot. Mình đã tham khảo trên Google Cloud Platform và thấy dịch vụ này phải trả tiền, chi tiết bạn có thể xem ở hình dưới.

[![IMG](https://4.bp.blogspot.com/-h14UihXItq8/WoXR7dFH24I/AAAAAAAADGY/ooIQ26u3baIVvRZa3vtzRWZjib5_JLBTQCLcBGAs/s640/2018-02-16_1-29-09.png "IMG")](https://4.bp.blogspot.com/-h14UihXItq8/WoXR7dFH24I/AAAAAAAADGY/ooIQ26u3baIVvRZa3vtzRWZjib5_JLBTQCLcBGAs/s1600/2018-02-16_1-29-09.png)

Vì vậy mình đã thử tìm trên Google cái API Google Translate Free và đã có kết quả.

[![](https://3.bp.blogspot.com/-w8RqksFWidE/WoXSmFAjlJI/AAAAAAAADGg/fAHkqMhPBn4kUq1q8lD8Ao3D2AliJASqACLcBGAs/s640/2018-02-16_1-29-09.png)](https://3.bp.blogspot.com/-w8RqksFWidE/WoXSmFAjlJI/AAAAAAAADGg/fAHkqMhPBn4kUq1q8lD8Ao3D2AliJASqACLcBGAs/s1600/2018-02-16_1-29-09.png)

URL:https://translate.googleapis.com/translate_a/single?client=gtx&sl=\[sourceLang\]&tl=\[targetLang\]&dt=t&q=\[sourceText\]

Mình thử thay giá trị của \[sourceLang\] là en (Tiếng Anh), targetLang là vi (Tiếng Việt), sourceText là 'Hi', truy cập thử thì phải một file là f.txt có nội dung như sau:

[![](https://2.bp.blogspot.com/-5I0HqVeeTOk/WoXUHRe6PBI/AAAAAAAADGw/ZTZQ8DIM-lwaKd-kH1hSA91MBpnbBZWaACLcBGAs/s640/2018-02-16_1-29-09.png)](https://2.bp.blogspot.com/-5I0HqVeeTOk/WoXUHRe6PBI/AAAAAAAADGw/ZTZQ8DIM-lwaKd-kH1hSA91MBpnbBZWaACLcBGAs/s1600/2018-02-16_1-29-09.png)

Đây là một đoạn JSON nên có thể dễ dàng decode nó sang dạng mảng được, và đây là kết quả:

[![](https://3.bp.blogspot.com/-83oH64WXXB0/WoXVC-fg_9I/AAAAAAAADHA/xxwAo6NF57QwjkRmaM1T8_aLPq41FFP0QCLcBGAs/s640/2018-02-16_1-29-09.png)](https://3.bp.blogspot.com/-83oH64WXXB0/WoXVC-fg_9I/AAAAAAAADHA/xxwAo6NF57QwjkRmaM1T8_aLPq41FFP0QCLcBGAs/s1600/2018-02-16_1-29-09.png)

Ta thấy trong đoạn JSON này sẽ trả về 3 dữ liệu là đoạn văn bản đã được dịch, đoạn văn bản gốc và ngôn ngữ của văn bản gốc. Vậy là ổn rồi, bắt đầu code thôi.

### Bắt đầu code
```php
$data = file\_get\_contents('https://translate.googleapis.com/translate\_a/single?client=gtx&sl='.$\_GET\[src\_lang\].'&tl='.$\_GET\[tar\_lang\].'&dt=t&q='.urlencode($\_GET\[q\]));
echo $data;
```
Và đây là kết quả:

[![](https://3.bp.blogspot.com/-CYNmuBHgxzs/WoXgPjIo9kI/AAAAAAAADHk/LUm5AaJVzrUS7g8yQWWuc2P6sOKx0Kr6ACLcBGAs/s640/2018-02-16_1-29-09.png)](https://3.bp.blogspot.com/-CYNmuBHgxzs/WoXgPjIo9kI/AAAAAAAADHk/LUm5AaJVzrUS7g8yQWWuc2P6sOKx0Kr6ACLcBGAs/s1600/2018-02-16_1-29-09.png)

Vậy là có thể dùng hàm file\_get\_contents để lấy dữ liệu, giờ thì decode nó ra và tạo tin nhắn gửi tới ChatFuel thôi.
```php
$data = json\_decode(file\_get\_contents('http://translate.googleapis.com/translate\_a/single?client=gtx&sl='.$\_GET\[src\_lang\].'&tl='.$\_GET\[tar\_lang\].'&dt=t&q='.urlencode($_GET\[q\])),true);
\# Tạo đoạn tin nhắn.
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => 'Bot đang dịch nè. Đợi một nốt nhạc thôi.'
            ),
            1 => array(
                'text' => '\*Bản dịch:\* ' .$data\[0\]\[0\]\[0\]
            ),
        ),
 );
    echo json_encode($reply);
```
Kết quả:

[![](https://3.bp.blogspot.com/-1UV-ULd_AJA/WoXhljSDKVI/AAAAAAAADHw/BTcF-vazbQYnbzNZxqOTWJQZHbeHnOiOwCLcBGAs/s640/2018-02-16_1-29-09.png)](https://3.bp.blogspot.com/-1UV-ULd_AJA/WoXhljSDKVI/AAAAAAAADHw/BTcF-vazbQYnbzNZxqOTWJQZHbeHnOiOwCLcBGAs/s1600/2018-02-16_1-29-09.png)

#### Vấn đề đầu tiền

Sau khi thêm tính năng vào chatbot, mình đã test thử khá nhiều lần và thấy có vấn đề khi cho dịch nhiều hơn 1 câu.

[![](https://4.bp.blogspot.com/-bBp7AJP5QbE/WoXj_0jr8KI/AAAAAAAADIU/7-G7l1pU3vQPY5utVoH9iOA_1GMUBQQ6gCLcBGAs/s640/2018-02-16_1-29-09.png)](https://4.bp.blogspot.com/-bBp7AJP5QbE/WoXj_0jr8KI/AAAAAAAADIU/7-G7l1pU3vQPY5utVoH9iOA_1GMUBQQ6gCLcBGAs/s1600/2018-02-16_1-29-09.png)

Khi dịch nhiều hơn 1 câu, bot chỉ dịch được câu đầu còn các câu sau không dịch. Mình đã thử lại và thấy đoạn JSON trả về lại có dạng như sau:

[![](https://4.bp.blogspot.com/-n8Ev8Rf_Oa4/WoXkUsZ1WaI/AAAAAAAADIY/uMbu-EXWg0wGXmPBJB6IF6UEgDFIAnFPQCLcBGAs/s640/2018-02-16_1-29-09.png)](https://4.bp.blogspot.com/-n8Ev8Rf_Oa4/WoXkUsZ1WaI/AAAAAAAADIY/uMbu-EXWg0wGXmPBJB6IF6UEgDFIAnFPQCLcBGAs/s1600/2018-02-16_1-29-09.png)

Ta thấy nó chia ra thành 2 phần, vậy thì làm sao để nối 2 phần lại với nhau. Ta thấy đoạn văn bản ta dịch có hai câu và đoạn JSON trả về cũng chia ra làm 2 key kết quả như trên ảnh. Vậy số câu bằng số key JSON. Vậy làm thế nào để xác định số câu trong đoạn văn bản. Ta thấy kết thúc câu là một dấu chấm, dấu phẩy, dấu hỏi chấm, dấu chấm than... Vậy chúng ta sẽ dựa vào sự xuất hiện của những dấu này để xác định số câu. Bình thường sau các dấu trên phải có dấu cách để tách thành 2 câu riêng biệt nhưng nếu sau những dấu trên không phải là dấu cách mà lại là kí tự đầu tiên của câu thì 2 câu đó được coi là 1 câu. Nếu mình giải thích nó hơi khó hiểu thì bạn hãy xem ảnh dưới:

[![](https://3.bp.blogspot.com/-JaCYXjleo4c/WoXny4QTXhI/AAAAAAAADI0/DXPhVmwq9AcpfhKKypbFWg3UbSYY2w3hQCLcBGAs/s640/2018-02-16_1-29-09.jpg)](https://3.bp.blogspot.com/-JaCYXjleo4c/WoXny4QTXhI/AAAAAAAADI0/DXPhVmwq9AcpfhKKypbFWg3UbSYY2w3hQCLcBGAs/s1600/2018-02-16_1-29-09.jpg)

Từ thuật toán trên ta sẽ có đoạn code sau:
```php
$req = $_GET\['q'\];
\# Đếm số câu.
    $text = '';
    $count = 0;
    for ($i=0; $i <= strlen($req); $i++) { 
            if (($req\[$i\] == '.' or $req\[$i\] == '!' or $req\[$i\] == '?') && $req\[$i+1\] == ' ') {
            $count = $count + 1;
        }
    }
    $count = $count +1;
\# Tạo chuỗi kết quả.
    for ($i=0; $i <= $count; $i++) { 
        $text = $text.$data\[0\]\[$i\]\[0\];
    }
```
Ghép nó vào đoạn code ban đầu, ta được kết quả:

[![](https://4.bp.blogspot.com/-nv6XiicxKLY/WoXpBaz7PvI/AAAAAAAADJE/QkFJeVu3Tq4m5Mf8eRneA1YUGGqdGSU_ACLcBGAs/s640/2018-02-16_3-09-14.png)](https://4.bp.blogspot.com/-nv6XiicxKLY/WoXpBaz7PvI/AAAAAAAADJE/QkFJeVu3Tq4m5Mf8eRneA1YUGGqdGSU_ACLcBGAs/s1600/2018-02-16_3-09-14.png)

Nice! Giờ thì ngon rồi, cho vào ChatFuel rồi xài thôi!

#### Vấn đề thứ hai

Mình tiếp tục test để tìm vấn đề. Đến lúc dịch Tiếng Nhật thì chatbot lại gửi cho mình một bản dịch không đúng một tí nào. "日本語" có nghĩa là "Tiếng Nhật" nhưng khi đặt giá trị src_lang là auto (tự động phát hiện ngôn ngữ) thì kết quả lại như thế này:

[![](https://3.bp.blogspot.com/-2KDAdErAkaI/WoXrBJd2DBI/AAAAAAAADJc/nFQBX0wNAs4uFgIfQ88XqLWFi_YeGgKPQCLcBGAs/s640/2018-02-16_3-09-14.png)](https://3.bp.blogspot.com/-2KDAdErAkaI/WoXrBJd2DBI/AAAAAAAADJc/nFQBX0wNAs4uFgIfQ88XqLWFi_YeGgKPQCLcBGAs/s1600/2018-02-16_3-09-14.png)

Thậm chí đặt giá trị src_lang là ja (Japan) kết quả cũng chẳng khả quan hơn.

[![](https://3.bp.blogspot.com/-cHdXxVVum2k/WoXrVk1rhhI/AAAAAAAADJg/zLEyTEE0Xok1FZp5ks2tGyrIcYLObg6KACLcBGAs/s640/2018-02-16_3-09-14.png)](https://3.bp.blogspot.com/-cHdXxVVum2k/WoXrVk1rhhI/AAAAAAAADJg/zLEyTEE0Xok1FZp5ks2tGyrIcYLObg6KACLcBGAs/s1600/2018-02-16_3-09-14.png)

Mình nghĩ trong lúc thực thi hàm file\_get\_contents, giá trị 日本語 đã bị biến đổi sang giá trị khác, mình thử cách gửi/nhận dữ liêu bằng cURL thì lại nhận kết quả đúng.

[![](https://1.bp.blogspot.com/-vYkwhQZFNOU/WoXtDOIjx8I/AAAAAAAADJs/oCSg7ZQJvmohx21e2-hFUCBmnnWmfdlLQCLcBGAs/s640/2018-02-16_3-09-14.png)](https://1.bp.blogspot.com/-vYkwhQZFNOU/WoXtDOIjx8I/AAAAAAAADJs/oCSg7ZQJvmohx21e2-hFUCBmnnWmfdlLQCLcBGAs/s1600/2018-02-16_3-09-14.png)

Khi mình encode thử thành dạng JSON thì không thể encode được, lên StackOverflow thì dùng code: (array) json_decode($string) đê decode trước rồi encode sau, in ra kết quả đúng:

[![](https://1.bp.blogspot.com/-145Y08UpLiI/WoXt2Thf-EI/AAAAAAAADJ0/uppB7Sl39ic_zcB4itrHzeZRXd830f2MACLcBGAs/s640/2018-02-16_3-09-14.png)](https://1.bp.blogspot.com/-145Y08UpLiI/WoXt2Thf-EI/AAAAAAAADJ0/uppB7Sl39ic_zcB4itrHzeZRXd830f2MACLcBGAs/s1600/2018-02-16_3-09-14.png)

Mình update lại ChatFuel và tiếp tục test, đến bây giờ vẫn chưa có vấn đề gì. Trong source code mình đã viết thêm một mảng nữa để xác định ngôn ngữ nhập vào, bạn có dùng hay không là tùy bạn.

Source Code:
```php
$req = $_GET\['q'\];
$fp = file\_get\_contents\_curl('https://translate.googleapis.com/translate\_a/single?client=gtx&sl='.$\_GET\['src\_lang'\].'&tl='.$\_GET\['tar\_lang'\].'&dt=t&q='.urlencode($_GET\['q'\]),5 );

\# Hàm mình tham khảo trên GitHub: https://gist.github.com/jrivero/5598138 .
function file\_get\_contents_curl($url, $retries=5)
{
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl\_setopt($ch, CURLOPT\_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
        curl\_setopt($ch, CURLOPT\_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl\_setopt($ch, CURLOPT\_CONNECTTIMEOUT, 10); // The number of seconds to wait while trying to connect.
        curl\_setopt($ch, CURLOPT\_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
        curl\_setopt($ch, CURLOPT\_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
        curl\_setopt($ch, CURLOPT\_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
        curl\_setopt($ch, CURLOPT\_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl\_setopt($ch, CURLOPT\_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
        curl\_setopt($ch, CURLOPT\_MAXREDIRS, 5); // The maximum number of redirects
        $result = curl_exec($ch);
        curl_close($ch);
    }
    else
    {
        $result = file\_get\_contents($url);
    }        
    if (empty($result) === true)
    {
        $result = false;
        if ($retries >= 1)
        {
            sleep(1);
            return file\_get\_contents_curl($url, --$retries);
        }
    }    
    return $result;
}
\# Convert dữ liệu xâu thành mảng.
    $data = (array) json_decode($fp);
\# Mảng chứa tên ngôn ngữ.
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
\# Đếm số câu.
    $text = '';
    $count = 0;
    for ($i=0; $i <= strlen($req); $i++) { 
            if (($req\[$i\] == '.' or $req\[$i\] == '!' or $req\[$i\] == '?') && $req\[$i+1\] == ' ') {
            $count = $count + 1;
        }
    }
    $count = $count +1;
\# Tạo chuỗi kết quả.
    for ($i=0; $i <= $count; $i++) { 
        $text = $text.$data\[0\]\[$i\]\[0\];
    }
\# Tạo đoạn tin nhắn.
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => 'Bot đang dịch nè. Đợi một nốt nhạc thôi.'
            ),
            1 => array(
                'text' => '\*Bản dịch:\* ' .$text
            ),
            2 => array(
                'text' => 'Số câu: '.$count
            ),
            3 => array(
                'text' => 'Ngôn ngữ của văn bản gốc: Tiếng '.$lang\[$data\[2\]\]
            )
        ),
);
    echo json_encode($reply);
```
Nếu có lỗi, các bạn có thể báo cáo cho mình tại [đây](http://www.facebook.com/100014453922085). Cảm ơn các bạn, chúc các bạn năm mới vui vẻ, thành công! **Update:** Chúng ta không cần dùng một đoạn code để tạo chuỗi kết quả nữa mà dùng hàm foreach để tạo chuỗi. Cách này sẽ đạt hiệu quả cao hơn mà code không bị dài.

```php
$data = file\_get\_contents\_curl('http://translate.googleapis.com/translate\_a/single?client=gtx&sl='.$\_GET\['src\_lang'\].'&tl='.$\_GET\['tar\_lang'\].'&dt=t&q='.urlencode($_GET\['q'\]),5 );

\# Hàm mình tham khảo trên GitHub: https://gist.github.com/jrivero/5598138 .
function file\_get\_contents_curl($url, $retries=5)
{
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl\_setopt($ch, CURLOPT\_URL, $url);
        curl\_setopt($ch, CURLOPT\_RETURNTRANSFER, TRUE);
        curl\_setopt($ch, CURLOPT\_CONNECTTIMEOUT, 10);
        curl\_setopt($ch, CURLOPT\_USERAGENT, $ua);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    else
    {
        $result = file\_get\_contents($url);
    }        
    if (empty($result) === true)
    {
        $result = false;
        if ($retries >= 1)
        {
            sleep(1);
            return file\_get\_contents_curl($url, --$retries);
        }
    }    
    return $result;
}
\# Convert dữ liệu xâu thành mảng.
    $data = (array) json_decode($data);
\# Mảng chứa tên ngôn ngữ.
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
\# Tạo chuỗi kết quả.
    $text = '';
    foreach ($data\[0\] as $key => $value) {
        $text .= $value\[0\];
    }

\# Tạo đoạn tin nhắn.
    $reply = array(
        'messages' => array(
            0 => array(
                'text' => 'Bot đang dịch nè. Đợi một nốt nhạc thôi.'
            ),
            1 => array(
                'text' => '\*Bản dịch:\* ' .$text
            ),
            2 => array(
                'text' => 'Ngôn ngữ của văn bản gốc: Tiếng '.$lang\[$data\[2\]\]
            )
        ),
);
    echo json_encode($reply);
    ```
