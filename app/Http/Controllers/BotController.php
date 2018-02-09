<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Text;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\Element\Button;
use CodeBot\SenderRequest;
use CodeBot\WebHook;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function subscribe()
    {
        $webHook = new WebHook;
        $subscribe = $webHook->check(config('botfb.validation_token'));
        if(!$subscribe){
            abort(403,'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(config('botfb.page_access_token'));
        $callSendApi->make($text->message('Oii, eu sou um bot..'));
        $callSendApi->make($text->message('Você digitou: '.$message));

        $message = new ButtonsTemplate($senderId);
        $message->add(new Button('web_url','CodeEducation','https://code.education'));
        $message->add(new Button('web_url','Google','https://www.google.com.br'));

        $callSendApi->make($message->message('Testando a abertura de um site'));

        return '';
    }
}
