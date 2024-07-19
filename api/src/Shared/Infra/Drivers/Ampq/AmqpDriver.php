<?php

namespace Aloefflerj\UniverseOriginApi\Shared\Infra\Drivers\Ampq;

use Aloefflerj\UniverseOriginApi\Shared\Component\Adapters\Messaging\Contracts\MessagingDriver;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class AmqpDriver implements MessagingDriver
{
    public function __construct(
        private AMQPStreamConnection $amqpConnection,
        private AMQPChannel $channel,
    ) {
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->amqpConnection->close();
    }

    public function send(\stdClass $message, string $queue): void
    {
        $this->channel->queue_declare(
            $queue,
            false,
            false,
            false,
            false,
        );

        $properties = [
            'content_type' => 'application/json'
        ];

        $amqpMessage = new AMQPMessage(
            json_encode($message),
            $properties
        );

        $this->channel->basic_publish($amqpMessage, '', $queue);
    }
}
