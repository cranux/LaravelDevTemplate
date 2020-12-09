<?php

namespace App\Handler;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * Class TextMessageHandler.
 */
class TextMessageHandler implements EventHandlerInterface
{
    /**
     * @param null $payload
     * @return false|string
     */
    public function handle($payload = null)
    {
        return json_encode($payload);
    }
}
