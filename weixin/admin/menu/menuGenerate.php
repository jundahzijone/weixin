<?php 
    
    /** 
     * 创建菜单 
     * @param $access_token 已获取的ACCESS_TOKEN 
     */ 
function createmenu($access_token) 
    { 
        $MENU_URL = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token; 
       
        $jsondata = '{
            "button":[
                {
                   "name":"目录",
                   "sub_button":[
                        {
                          "type":"click",    
                         "name":"集团概况",
                         "key":"view_groub" 
                        },
                        {
                             "type":"click", 
                            "name":"国际课程", 
                            "key":"group_class"
                         },
                         {
                            "type":"click", 
                            "name":"招生咨询qqqqqq", 
                            "key":"eroll_query"

                         },
                         {
                            "type":"click",
                            "name":"团队风采", 
                            "key":"team_activity" 

                         }

                      ] 

                },
                {
                    "name":"校园风采",
                   "sub_button":[
                        {
                              "name":"校园通知", 
                            "type":"click", 
                            "key":"school_notice"
                        },
                        {
                            "name":"缤纷活动", 
                            "type":"click", 
                            "key":"funny_enjoy" 
                        },
                        {
                              "name":"进入班级", 
                            "type":"click", 
                            "key":"enter_class" 
                        }

                      ] 

                },
                {
                   "name":"本周推荐",
                   "sub_button":[
                       {
                         "name":"本周食谱", 
                            "type":"click", 
                            "key":"week_cookbook" 
                       },
                       {
                          "name":"亲子教育", 
                            "type":"click", 
                            "key":"pc_education" 
                       },
                       {
                            "name":"童言趣语", 
                            "type":"click", 
                            "key":"children_voice" 
                       }

                      ] 

                }
            ]
        }';
           
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, $MENU_URL); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        $info = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch);
            curl_close($ch);
            return 0;
        }
        else
          return 1;

        

    } 
  

?>