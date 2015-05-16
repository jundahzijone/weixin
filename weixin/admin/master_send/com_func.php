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


function get_openid($access_token)
{
    $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$access_token";
    $result = https_request($url);
    // echo $result;
    $jsoninfo = json_decode($result, true);
    // var_dump($result);
    if(is_array($jsoninfo['data']['openid']))
        return $jsoninfo['data']['openid'];
    else
       return 0;

}


function master_send_text($access_token,$userid_arr)
{
    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$access_token";
    
 
    $txt = '{ "touser":[';

    $j = 0;
    foreach ($userid_arr as $key => $value) {
        
         $txt .= '"'.$value.'"';

        if($j<(count($userid_arr)-1))
            $txt .= ','; 
        $j++;
    }

    $txt .= '],';
    $txt .= '"msgtype":"text",';
    
    $txt .= '"text": { "content": "hello, welcome to GuangZhou."}}';


    echo $txt;

    $result = https_request($url,$txt);

    echo $result;
    // var_dump($result)

   //  {
   // "touser":[
   //  "OPENID1",
   //  "OPENID2"
   // ],
   //  "msgtype": "text",
   //  "text": { "content": "hello from boxer."}
   //  }


}

?>