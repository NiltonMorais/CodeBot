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
use CodeBot\Build\Solid;
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
        $postback = $sender->getPostback();

        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.page_access_token'));
        Solid::setSenderId($senderId);

        if($postback){
            if(is_array($postback)){
                $postback = json_encode($postback);
            }
            $bot->message('text', 'Você chamou o postback '.$postback);
            return '';
        }

        $bot->message('text','Oi, eu sou um Bot ;)');
        $bot->message('text','Você digitou: '.$message);

        $bot->message('image','https://media.giphy.com/media/kEKcOWl8RMLde/giphy.gif');
        $bot->message('audio','https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3');

        $buttons = [
            new Button('web_url', "Angular Js", 'https://angular.io/'),
            new Button('web_url', "Vue Js", 'https://vuejs.org/')
        ];

        $bot->template('buttons', 'Escolha um curso', $buttons);

        $products = [
            new Product(
                'Produto 1',
                'https://pluralsight.imgix.net/paths/path-icons/angular-14a0f6532f.png',
                'Curso de Angular', 
                new Button('web_url', null, 'https://angular.io/')
            ),
            new Product(
                'Produto 2',
                'https://vuejs.org/images/logo.png',
                'Curso de VueJS', 
                new Button('web_url', null, 'https://vuejs.org/')
            ),
        ];

        $bot->template('generic', '', $products);
        $bot->template('list', '', $products);

        return '';
    }
}
