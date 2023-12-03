<?php

namespace App\Console\Commands\Workers;

use App\Constants\QueueNames;
use App\Mail\User\AccountVerificationEmail;
use Core\Domain\Users\Exceptions\UserNotFoundException;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class SendAccountVerificationEmailConsumer extends BaseConsumer
{
    public function __construct(
        private readonly FindUserByEmailOutputPort $findUserByEmailOutputPort,
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:sendAccountVerificationEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Consumer';

    protected string $queueName = QueueNames::SEND_ACCOUNT_VERIFICATION_QUEUE;

    /**
     * @throws UserNotFoundException
     */
    public function executeQueue(AMQPMessage $message): void
    {
        $body = json_decode($message->getBody());
        $user = $this->findUserByEmailOutputPort->findUserByEmail($body->email);

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        Mail::to($user->getEmail())->send(new AccountVerificationEmail($user));
    }
}
