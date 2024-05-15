<?php

    error_reporting(0);
    define('BOT_TOKEN', '----------bot-token-------------'); //sample : '441848989:AAHX156as4dasd5d56as19ztxvD-eTI1hsb8'
    
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    
    $old_domain = "Mydomain.shop"; // with out http or https; Example: Mydomain.shop
    $new_domain = "https://MyNewdomain.site"; // http and https required; Example: https://MyNewdomain.site
    
    #########################################################################################################################
    function changeDomain($url){
        $parsed_url = parse_url($url);
        if($parsed_url['host'] == $old_domain){
            $new_url = $new_domain . $parsed_url['path'];
            return $new_url;
        }else{
            return "لینک وارد شده صحیح نیست.";
        }//EndIF
    }//changeDomain
    
    
    function sendMessage($chatId, $message){
      $url = 'https://api.telegram.org/bot' . BOT_TOKEN . '/sendMessage';
      $data = array('chat_id' => $chatId, 'text' => $message);
      $options = array(
        'http' => array(
          'method' => 'POST',
          'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($data),
        ),
      );//$options
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
    }//sendMessage
    #########################################################################################################################
    
    $message = isset($update['message']) ? $update['message'] : "";
    
    $text = isset($message['text']) ? $message['text'] : "";
    
    if($text=="/start"){
        sendMessage($message['chat']['id'], "لطفا لینک را وارد کنید.");
    }else{
        sendMessage($message['chat']['id'], changeDomain($text));
    }//EndIF
    
?>