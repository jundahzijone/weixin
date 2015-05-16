<?php 


require_once realpath(dirname(__FILE__)."/./admin/menu/menuGenerate.php");
require_once realpath(dirname(__FILE__)."/./admin/text/responseTextFunc.php");
require_once realpath(dirname(__FILE__)."/./admin/message_forward/transmit.php");
require_once realpath(dirname(__FILE__)."/./include/config.php");

// require_once("./master_send/send.php");


//define your token 
define("TOKEN", "hzijone");//改成自己的TOKEN 
define('APP_ID', 'wx631555c77c40ffd8');//改成自己的APPID 
define('APP_SECRET', 'f8c5bb70b9ade0be9329fc3d2ed8bdf6');//改成自己的APPSECRET 
 
$wechatObj = new wechatCallbackapiTest(APP_ID,APP_SECRET); 
$wechatObj->Run(); 
 
class wechatCallbackapiTest 
{ 
    
    private $app_id; 
    private $app_secret; 
     
    public function __construct($appid,$appsecret) 
    { 
        # code... 
        $this->app_id = $appid; 
        $this->app_secret = $appsecret; 
    } 
    public function valid() 
    { 
        $echoStr = $_GET["echostr"]; 
        if($this->checkSignature()){ 
            echo $echoStr; 
            exit; 
        } 
    } 
    /** 
     * 运行程序 
     * @param string $value [description] 
     */ 
    public function Run() 
    { 
        $this->responseMsg(); 
       
    } 

    public function responseMsg() 
    {    


        // 菜单的创建应该分离出来 
         $access_token = get_access_token($this->app_id,$this->app_secret);//获取access_token 
         if(empty($access_token) )
           { 
             echo  "获取access_token错误";
             return;
           }
         
         $ret = createmenu($access_token);//创建菜单
         if($ret == 0)
          {
             echo "创建菜单失败";
             return ;
          }


        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//返回回复数据 



        if (!empty($postStr))
               { 
               
                    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
                  
                    $MsgType = $postObj->MsgType;//消息类型 


                    switch ($MsgType) 
                        {
                            case 'event':
                                $resultStr = $this->handleEvent($postObj);
                                break;

                             case 'text':  // 用户输入内容
                                $resultStr = $this->handleText($postObj);
                                break;
                            
                             // case 'view':


                             default:
                                $resultStr = "Unknow msg type: ".$MsgType;
                                break;
                        }

                    echo $resultStr;    

        }else { 
            echo "this a file for weixin API!"; 
            exit; 
        } 
    } 
  



 public function handleEvent($postObj)
    {
        $contentStr = "";
        switch ($postObj->Event)
        {
            case "subscribe":
                $contentStr = "感谢您关注【Hzijone】 公众测试平台";
               $resultStr = response_text($postObj, $contentStr);

                break;

            case "CLICK":

               //      $contentStr = "感谢您关注【Hzijone】"."\n"."公众测试平台";
            		 // $resultStr = _response_text($postObj, $contentStr);
           			 $resultStr = get_response($postObj,$postObj->EventKey);
                break;           
            default :
                // $contentStr = "Unknow Event: ".$postObj->Event;
                // $resultStr = _response_text($postObj, $contentStr);
                break;
        }

        return $resultStr;
    }



// 用户输入内容的回复
public function handleText($postObj)
    {
        $keyword = trim($postObj->Content);

        if(!empty( $keyword ))
        {
            $contentStr = "微信公众平台-文本回复功能源代码";
            //$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            $resultStr = response_text($postObj,$contentStr);
            echo $resultStr; //echo == return
        }else{
            echo "Input something...";
        }
    }

   
 









    private function checkSignature() 
    { 
        $signature = $_GET["signature"]; 
        $timestamp = $_GET["timestamp"]; 
        $nonce = $_GET["nonce"];     
                 
        $token = TOKEN; 
        $tmpArr = array($token, $timestamp, $nonce); 
        sort($tmpArr); 
        $tmpStr = implode( $tmpArr ); 
        $tmpStr = sha1( $tmpStr ); 
         
        if( $tmpStr == $signature ){ 
            return true; 
        }else{ 
            return false; 
        } 
    } 
} 
?>