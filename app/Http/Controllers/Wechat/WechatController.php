<?php

namespace App\Http\Controllers\Wechat;

use App\Handler\EventMessageHandler;
use App\Handler\TextMessageHandler;
use App\Http\Controllers\Controller;
use EasyWeChat\Kernel\Messages\Message;
use Illuminate\Http\Request;
use Overtrue\LaravelWeChat\Facade;

class WechatController extends Controller
{
    public function serve()
    {
        $app = Facade::officialAccount();
        $app->server->push(TextMessageHandler::class, Message::TEXT);
        $app->server->push(EventMessageHandler::class, Message::EVENT);

        return $app->server->serve();
    }
}
