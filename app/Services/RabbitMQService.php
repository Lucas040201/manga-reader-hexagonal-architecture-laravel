<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;

class RabbitMQService
{
    private AMQPStreamConnection $connection;

    private AMQPChannel $channel;

    public function __construct()
    {
        $config = config('rabbitmq');
        $this->connection = new AMQPStreamConnection(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password'],
            $config['vhost']
        );
        $this->channel = $this->connection->channel();
    }

    public function consume(string $queueName, Closure $callback): void
    {
        try {
            echo "Initializing consumer of queue [$queueName]" . PHP_EOL;
            $this->channel->queue_declare($queueName, false, true, false, false);
            $this->channel->basic_consume($queueName, '', false, false, false, false, $callback);
            echo 'Waiting for messages...' . PHP_EOL;
            while (!empty($this->channel->callbacks)) {
                $this->channel->wait();
            }
            $this->channel->close();
            $this->connection->close();
        } catch (Exception $e) {
            echo "\nError: {$e->getMessage()}" . PHP_EOL;
            $this->connection->close();
        }
    }

    public function consumeAck(AMQPMessage $message, string $queueName): void
    {
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
        echo "\n[x] Done {$queueName}. {$message->getBody()}" . PHP_EOL;

    }

    public function publish(string $queueName, $message): void
    {
        $this->channel->queue_declare($queueName, false, true, false, false);
        $this->channel->basic_publish(new AMQPMessage(json_encode($message)), '', $queueName);
        $this->channel->close();
        $this->connection->close();
    }
}
