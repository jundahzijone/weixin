<?php 
require_once("com_func.php");

// 设置定时器进行定时发送
// 微信用户如果24小时之内未与微信公众号互动过，则公众号无法向该微信用户发送客服消息
$app_id = "wx631555c77c40ffd8";
$app_secret = "f8c5bb70b9ade0be9329fc3d2ed8bdf6";


 $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$app_secret; 
        $data = json_decode(file_get_contents($url),true); 

        if($data['access_token']){ 
            // return $data['access_token']; 
        }else{ 
            // return "获取access_token错误"; 
            return 0;
        } 
$access_token = $data['access_token'];

// echo $access_token;

 _master_send($access_token);

function _master_send($access_token)
{
	
	//获取用户open_id
     $userid_arr = get_openid($access_token);
     if($userid_arr == 0)
     	return "获取用户id失败";

     // print_r($userid_arr);


   // 发送文本内容
   	$ret = master_send_text($access_token,$userid_arr);
    if($ret == 0)
     	return "发送文本内容失败";

}










?>