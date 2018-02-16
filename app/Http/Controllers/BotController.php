<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Text;
use CodeBot\SenderRequest;
use CodeBot\WebHook;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
use CodeBot\TemplatesMessage\GenericTemplate;
use CodeBot\TemplatesMessage\ListTemplate;
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

        $button1 = new Button('web_url', null, 'https://angular.io/');
        $button2 = new Button('web_url', null, 'https://vuejs.org/');
        $product1 = new Product('Produto 1','https://angular.io/assets/images/logos/angular/angular.svg','Curso de Angular', $button1);
        $product2 = new Product('Produto 2','https://vuejs.org/images/logo.png','Curso de VueJS', $button2);
        $template = new GenericTemplate($senderId);
        $template->add($product1);
        $template->add($product2);
        $callSendApi->make($template->message('qwe'));

        $template = new ListTemplate($senderId);
        $template->add($product1);
        $template->add($product2);
        $callSendApi->make($template->message('qwe'));

        return '';
    }
}
