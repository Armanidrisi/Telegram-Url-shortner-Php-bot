<!--Subscribe @armanidrisi1 on youtube-->
<?php
//Creating a function for sending message in,bot
function send($chat,$msg){
$msgs=urlencode($msg);
$api="https://api.telegram.org/bot<ADD YOUR BOT TOKEN>/sendMessage?chat_id=$chat&text=$msgs&parse_mode=html";
file_get_contents($api);
}

//Getting User Input
$input = file_get_contents('php://input');
$data=json_decode($input);

//Getting User Message 
$text=$data->message->text;

//Getting User Name And I'd

$firstname=$data->message->from->first_name;
$lastname=$data->message->from->last_name;
$chatid=$data->message->chat->id;

//Now Code Start

if($text=='/start'){
send($chatid,"<b>Hello $firstname $lastname Welcome To Our Bot</b>");
}else{
$link=urlencode($text);
if(filter_var($text,FILTER_VALIDATE_URL)){
$apikey="ADD YOUR API KEY";
$api="https://api-ssl.bitly.com/v3/shorten?access_token=$apikey&longUrl=$link";
$file=file_get_contents($api);
$js=json_decode($file);
$url=$js->data->url;
send($chatid,"Your Url has been Successfully Generated\nShort Url: $url");
}else{
send($chatid,"<b>⚡️ Please Send A Valid Url</b>");
}
}
?>
