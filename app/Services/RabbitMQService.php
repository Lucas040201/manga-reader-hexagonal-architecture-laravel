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
    private string $host;
    private string $port;
    private string $user;
    private string $password;

    public function __construct()
    {
        $this->host = getenv('RABBIT_MQ_HOST');
        $this->port = getenv('RABBIT_MQ_PORT');
        $this->user = getenv('RABBIT_MQ_USER');
        $this->password = getenv('RABBIT_MQ_PASSWORD');
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
    }

    public function consume(string $queueName, Closure $callback): void
    {
        try {
            echo "Initializing consumer of queue [$queueName]", " \n";
            $channel = $this->createChannel($queueName);
            $channel->basic_consume($queueName, '', false, false, false, false, $callback);
            echo 'Waiting for messages...', " \n";
            while (!empty($channel->callbacks)) {
                $channel->wait();
            }
            $channel->close();
            $this->connection->close();
        } catch (Exception $e) {
            echo "\nError: " . $e->getMessage() . "\n";
            $this->connection->close();
        }
    }

    public function consumeAck(AMQPMessage $message, string $queueName): void
    {
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
        echo "[x] Done $queueName. {$message->getBody()}";
    }

    private function createChannel(string $queueName, bool $durable = false): AMQPChannel
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($queueName, false, $durable);
        $channel->basic_qos(0, 1, false);
        return $channel;
    }

    public function publish(string $queueName, $message): void
    {
        $channel = $this->createChannel($queueName, true);
        $channel->exchange_declare('default_exchange', 'direct', false, true, false);
        $channel->queue_bind($queueName, 'default_exchange');
        $msg = new AMQPMessage(json_encode($message));
        $channel->basic_publish($msg);
        $channel->close();
        $this->connection->close();
    }


}
