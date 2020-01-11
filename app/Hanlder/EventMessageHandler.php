<?php

namespace App\Handler;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * Class EventMessageHandler.
 */
class EventMessageHandler implements EventHandlerInterface
{
    /**
     * @param array $payload
     * @return string
     */
    public function handle($payload = null)
    {
        $event = $payload['Event'];
        $eventKey = $payload['EventKey'];
        $openId = $payload['FromUserName'];

        switch ($event) {
            case 'subscribe':
                return '谢谢关注';
                break;
            case 'unsubscribe':
                //用户取消关注,根据实际情况处理
                break;
            case 'CLICK':
                return '点击的公众号菜单';
                break;
            case 'SCAN':
                return '用户已关注公众号,并且重新扫描了公众号二维码';
                break;
            default:
                return "未处理的事件类型:{$event}";
        }
    }
}
