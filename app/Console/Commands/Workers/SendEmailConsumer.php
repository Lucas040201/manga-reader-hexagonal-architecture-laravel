<?php

namespace App\Console\Commands\Workers;

use App\Constants\QueueNames;
use PhpAmqpLib\Message\AMQPMessage;

class SendEmailConsumer extends BaseConsumer
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:sendVerifyEmailWorker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Consumer';

    protected string $queueName = QueueNames::SEND_VERIFY_EMAIL_QUEUE;

    public function executeQueue(AMQPMessage $message): void
    {
        print_r(json_decode($message->getBody()));
    }
}
