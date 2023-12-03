<?php

namespace App\Console\Commands\Workers;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;

abstract class BaseConsumer extends Command
{
    protected RabbitMQService $rabbitMqService;

    protected string $queueName;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->createRabbitMQServiceInstance();
        $this->rabbitMqService->consume($this->queueName, $this->consumerWrapper());
    }

    private function createRabbitMQServiceInstance(): void
    {
        $this->rabbitMqService = new RabbitMQService();
    }

    private function consumerWrapper(): Closure
    {
        return function (AMQPMessage $message) {
            try {
                echo "\n[x] {$this->queueName} Received: {$message->getBody()}" . PHP_EOL;
                $this->executeQueue($message);
                $this->rabbitMqService->consumeAck($message, $this->queueName);
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        };
    }

    public abstract function executeQueue(AMQPMessage $message);
}
