<?php 
function response_text($postObj,$contentArr)
    { 


        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $time = time();

        //=================xml header============ 
        $textTpl="<xml> 
                    <ToUserName><![CDATA[%s]]></ToUserName> 
                    <FromUserName><![CDATA[%s]]></FromUserName> 
                    <CreateTime>%s</CreateTime> 
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content> 
                    <FuncFlag>{0}</FuncFlag>
            </xml>"; 

                     
      

         //=================end return============ 
        $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$contentArr);
        return $resultStr;
    } 




 // 回复单个图文信息
function response_news($postObj,$contentArr)
    { 

    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $time = time();

        

        //回应图文信息
    $newsTplHead = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>";

    $newsTplBody = "<item>
                <Title><![CDATA[%s]]></Title> 
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>";

    $newsTplFoot = "</Articles>
                <FuncFlag>0</FuncFlag>
                </xml>";
 

// 头部
 $header = sprintf($newsTplHead, $fromUsername, $toUsername, $time);



// 主体 
    if(is_array($contentArr))
        {
            $title = $contentArr['title'];
            $desc = $contentArr['description'];
            $picUrl = $contentArr['picUrl'];
            $url = $contentArr['url'];

        }
    else
        {

        $title = "china";
        $desc = "chinatitle";
        $picUrl = "http://2.hzijone.sinaapp.com/Sunset.jpg";
        $url = "http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000046&itemidx=1&sign=9e7707d5615907d483df33ee449b378d#wechat_redirect";


        }
$body = sprintf($newsTplBody, $title, $desc, $picUrl, $url);



            // 尾部
            $FuncFlag = 0;
            $footer = sprintf($newsTplFoot, $FuncFlag);




         return $header.$body.$footer;

          
   }




function response_multiNews($postObj,$contentArr)
{
    $newsTplHead = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>";
    $newsTplBody = "<item>
                    <Title><![CDATA[%s]]></Title> 
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                    </item>";
    $newsTplFoot = "</Articles>
                    <FuncFlag>0</FuncFlag>
                    </xml>";

    $bodyCount = count($contentArr);
    $bodyCount = $bodyCount < 10 ? $bodyCount : 10;

    $header = sprintf($newsTplHead, $postObj->FromUserName, $postObj->ToUserName, time(), $bodyCount);
    

if(is_array($contentArr))
    {
        foreach($contentArr as $key => $value)
         {
            $body .= sprintf($newsTplBody, $value['title'], $value['description'], $value['picUrl'], $value['url']);
         }
    }
else
 {

        $title = "china";
        $desc = "chinatitle";
        $picUrl = "http://2.hzijone.sinaapp.com/Sunset.jpg";
        $url = "http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000046&itemidx=1&sign=9e7707d5615907d483df33ee449b378d#wechat_redirect";

        $body = sprintf($newsTplBody, $title, $desc, $picUrl, $url);

 }    


    $FuncFlag = 0;
    $footer = sprintf($newsTplFoot, $FuncFlag);



    return $header.$body.$footer;
} 
  



?>