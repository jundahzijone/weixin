<?php 
  require_once realpath(dirname(__FILE__)."/../text/responseTextFunc.php");
  require_once realpath(dirname(__FILE__)."/../text/text.php");


// 主要转发消息，以及指定转发指定文本内容
function  get_response($postObj,$evenKey)
{


    global $view_groub,$group_class,$multi_news;

   switch ($evenKey) {
            case 'view_groub':
              $resultStr = response_news($postObj,$view_groub);
            break;
            
            case 'group_class':
              $resultStr = response_news($postObj,$group_class);           
            break;
            
            case 'eroll_query':
              $resultStr = response_news($postObj,$view_groub);               
            break;

            case 'team_activity':   
              $resultStr = response_news($postObj,$group_class);                        
            break;

            case 'school_notice':
              $resultStr = response_news($postObj,$view_groub);
            break;

            case 'funny_enjoy':
              $resultStr = response_news($postObj,$group_class);               
            break;

            case 'enter_class':
              $resultStr = response_news($postObj,$view_groub);               
            break;

            case 'week_cookbook':
              $resultStr = response_news($postObj,$group_class);              
            break;

            case 'pc_education':
              $resultStr = response_news($postObj,$view_groub);               
            break;
            
            case 'children_voice':
              $resultStr = response_multiNews($postObj,$multi_news);               
            break;
       default:
           $contentStr = "抱歉，系统暂时出现问题";
           $resultStr = response_text($postObj, $contentStr);       
           break;
   }

  
  return $resultStr;



}











?>