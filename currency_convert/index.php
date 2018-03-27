<?php
 header('Content-Type: text/html; charset=utf-8');
$array = json_decode(file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q=$_GET[from]_$_GET[to]&compact=y"),TRUE);
$value = $array["$_GET[from]_$_GET[to]"][val] * $_GET[amount];
$rep  = array(
		'messages' => array(
				0 => array(
						'text' => "$_GET[amount] $_GET[from] = $value $_GET[to]"
				)
		)
);
echo json_encode($rep);

?>
