<?php

declare(strict_types=1);

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\StackLogger;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//REFACTOR: improve stack logger logic
class StackLogger
{
    private AMQPChannel $channel;
    private AMQPStreamConnection $amqpsConnection;

    public function __construct()
    {
        $this->amqpsConnection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $this->amqpsConnection->channel();
        // $this->channel->queue_delete('hello');
        $this->channel->queue_declare('cleanArch', false, false, false, false);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->amqpsConnection->close();
    }

    public function send(StackLoggerSendMessageDAO $msg): void
    {
        $msg = new AMQPMessage(
            json_encode($msg),
            [
                'content_type' => 'application/json'
            ]
        );

        $this->channel->basic_publish($msg, '', 'cleanArch');
        sleep(1);
    }
}
