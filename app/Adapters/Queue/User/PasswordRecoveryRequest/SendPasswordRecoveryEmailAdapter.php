<?php

namespace App\Adapters\Queue\User\PasswordRecoveryRequest;

use App\Constants\QueueNames;
use App\Services\RabbitMQService;
use Core\Domain\Users\Entity\PasswordRecoveryEntity;
use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\SendPasswordRecoveryEmailOutputPort;

class SendPasswordRecoveryEmailAdapter implements SendPasswordRecoveryEmailOutputPort
{
    public function __construct(
        private readonly RabbitMQService $rabbitMQService
    )
    {
    }

    public function send(PasswordRecoveryEntity $passwordRecovery, UserEntity $user): void
    {
        $this->rabbitMQService->publish(
            QueueNames::SEND_PASSWORD_RECOVERY_QUEUE,
            [
                'token' => $passwordRecovery->getToken(),
                'email' => $user->getEmail()
            ]
        );
    }
}
