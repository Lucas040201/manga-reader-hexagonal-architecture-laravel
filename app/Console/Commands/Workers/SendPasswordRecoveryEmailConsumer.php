<?php

namespace App\Console\Commands\Workers;

use App\Constants\QueueNames;
use App\Mail\User\PasswordRecoveryEmail;
use Core\Domain\Users\Exceptions\PasswordRecoveryRequestNotFoundException;
use Core\Domain\Users\Exceptions\UserNotFoundException;
use Core\Domain\Users\Ports\Out\FindPasswordRecoveryByTokenOutputPort;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class SendPasswordRecoveryEmailConsumer extends BaseConsumer
{
    public function __construct(
        private readonly FindUserByEmailOutputPort $findUserByEmailOutputPort,
        private readonly FindPasswordRecoveryByTokenOutputPort $findPasswordRecoveryByTokenOutputPort
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:sendPasswordRecovery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send password recovery email Consumer';

    protected string $queueName = QueueNames::SEND_PASSWORD_RECOVERY_QUEUE;

    /**
     * @throws UserNotFoundException|PasswordRecoveryRequestNotFoundException
     */
    public function executeQueue(AMQPMessage $message): void
    {
        $body = json_decode($message->getBody());
        $user = $this->findUserByEmailOutputPort->findUserByEmail($body->email);

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $passwordRecovery = $this->findPasswordRecoveryByTokenOutputPort->find($body->token);

        if (empty($passwordRecovery)) {
            throw new PasswordRecoveryRequestNotFoundException();
        }

        Mail::to($user->getEmail())->send(new PasswordRecoveryEmail($passwordRecovery));
    }

}
