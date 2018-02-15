<?php
 header('Content-Type: text/html; charset=utf-8');
 $sotien = $_GET[amount];
 $ci = $_GET[ci];
 $co = $_GET[co];
 $json = file_get_contents('http://api.rest7.com/v1/currency_convert.php?amount='.$sotien.'&currency_in='.$ci.'&currency_out='.$co);
 $text = json_decode($json, true);
 $rep  = array(
     'messages' => array(
         0 => array(
             'text' => $_GET[amount].' '.$_GET[ci].' = '.$text['amount'].' '.$_GET[co]
         )
     )
 );
 echo json_encode($rep);
?>
