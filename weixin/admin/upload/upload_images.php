<?php
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}


$type = "image";
$filepath = dirname(__FILE__)."flower.jpg";
$filedata = array("media"=>"@".$filepath);
$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token"
$result = https_request($url,$filedata);

var_dump($result)

?>