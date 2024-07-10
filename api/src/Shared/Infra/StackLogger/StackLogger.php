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
        $this->channel->queue_declare('cleanArch', false, false, false, false);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->amqpsConnection->close();
    }

    public function send(StackLoggerSendMessageDTO $msg): void
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

    public static function sendStatically(): void
    {
        if (!isset(getallheaders()['debug'])) {
            return;
        }

        $debug = debug_backtrace();
        $stackLogger = new self();

        $previousFunctionExecution = $debug[1];
        $fullClassName = $previousFunctionExecution['class'];
        $fullClassNameArray = explode('\\', $previousFunctionExecution['class']);
        $className = end($fullClassNameArray);
        $functionName = $previousFunctionExecution['function'];
        $fileName = $previousFunctionExecution['file'];

        $abstractionLayer = match (1) {
            preg_match("/[\w\/]+Route.*/", $fileName) => AbstractionLayer::FRAMEWORK_DRIVER->value,
            preg_match("/\w+Action/", $className) => AbstractionLayer::ADAPTER->value,
            preg_match("/\w+MysqlRepository/", $className) => AbstractionLayer::ADAPTER->value,
            preg_match("/MysqlDatabaseDriver/", $className) => AbstractionLayer::FRAMEWORK_DRIVER->value,
            preg_match("/\w+UseCase/", $className) => AbstractionLayer::USE_CASE->value,
            preg_match("/[\w\\\]+Domain\\\.+/", $fullClassName) => AbstractionLayer::DOMAIN->value,
            default => AbstractionLayer::UNKNOWN->value
        };

        $abstractionType = match(1) {
            preg_match("/[\w\/]+Route.*/", $fileName) => AbstractionType::WEB_FRAMEWORK->value,
            preg_match("/\w+Action/", $className) => AbstractionType::WEB_ADAPTER->value,
            preg_match("/\w+MysqlRepository/", $className) => AbstractionType::MYSQL_ADAPTER->value,
            preg_match("/MysqlDatabaseDriver/", $className) => AbstractionType::MYSQL_DRIVER->value,
            preg_match("/\w+UseCase/", $className) => AbstractionType::USE_CASE->value,
            preg_match("/[\w\\\]+Domain\\\.+/", $fullClassName) => AbstractionType::DOMAIN->value,
            default => AbstractionLayer::UNKNOWN->value
        };

        $fileNameArray = explode('/', $fileName);
        $className = $className === 'Closure' ? end($fileNameArray) : $className;
        $className = str_replace('.php', '', $className);

        $stackLogger->send(
            new StackLoggerSendMessageDTO(
                'StackLoggger',
                $className,
                $functionName,
                $abstractionLayer,
                $abstractionType
            )
        );
    }
}
