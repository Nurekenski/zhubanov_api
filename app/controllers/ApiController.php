<?php
namespace Controllers;
use Models\Api;

class ApiController extends Controller
{

       /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     */

    public function insert($request, $response, $args = [])
    {
        $name = $this->getParam('name');
        $email = $this->getParam('email');
        $comment = $this->getParam('comment');
       
        $insertLatin = Api::insert($name,$email,$comment);

        return $insertLatin;
    }

    public function get($request, $response, $args = [])
    {
        $get = Api::get();

        return $get;
    }
    public function telegram($msg) {
        $telegrambot='1001585847:AAG3nuMsP8o9RfuTFBeg3AhYdb2PPcaZDwE';
        $telegramchatid=281900870;
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
    }

    public function insertAkeac($request, $response, $args = [])
    {   
      
        // $text = "ththth";
        // $chat_id = '1001585847';
        // echo $this->api_url;
        // var_dump(file_get_contents($this->api_url . $this->bot_api_key . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text));
        
        $name = $this->getParam("name");
        $phone = $this->getParam('phone');
        $type = $this->getParam('type');
        $email = $this->getParam('email');

        $msg = $name." \n ".$phone." \n".$type." \n".$email; 
        $this->telegram($msg);

        $insertLatin = Api::insertAceak($name,$phone,$type,$email);

      
        if($insertLatin) {
            return $this->success(OK,
                    [
                        'message' => 'Ok',
                    ]
            );
        }
   
    }
}