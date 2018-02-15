<?php 
if ($_GET['hub_mode'] == 'subscribe' && $_GET['hub_verify_token'] == '0x2f0713') {
	echo $_GET['hub_challenge'];
}
$fp = @fopen('test.txt', "w");
fwrite($fp, var_dump(json_decode($_POST['json'])));
fclose($fp);
 ?>