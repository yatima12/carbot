<?php
$strAccessToken = "tMGQidpIGcNw+oheqcQ/oN8SkTm61i8zgYDOjuSYx47Q0FtfHC5bifMfiFuMjDfiaLU2hP5nSiwyxskB5f+y1dtkjlY6Jm+85rZyM18BgXRNOm0/gENjT2xHCEO0hdJfEMmsU01ehlgM081A07cbZAdB04t89/1O/w1cDnyilFU=";
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$_userId = $arrJson['events'][0]['source']['userId'];
$_msg = $arrJson['events'][0]['message']['text'];
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$filename = 'text.txt';
if (file_exists($filename)) {
$myfile = fopen('abc.txt', "w+") or die("Unable to open file!");
fwrite($myfile, $_msg);
fclose($myfile);
} else {
$myfile = fopen('abc.txt', "x+") or die("Unable to open file!");
fwrite($myfile, $_msg);
fclose($myfile);
}
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "สวัสดี ID ของคุณคือ ".$arrJson['events'][0]['source']['userId'];
}else if($arrJson['events'][0]['message']['text'] == "123456789") // เป็นรหัสเปลดล็อด
{
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "เรียบร้อยคับ";
}else{
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "รหัสไม่ถูกต้อง";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
?>
