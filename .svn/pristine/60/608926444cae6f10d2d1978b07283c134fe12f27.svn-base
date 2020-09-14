<?php 
$example_ip = '8.8.8.8';
$TOKEN = '78896b4e8ecdb5';
$url = 'http://ipinfo.io/'.$example_ip.'?token='.$TOKEN;

$ch = curl_init($url);

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

print "<pre>";
print_r($data);
print "</pre>";


?>