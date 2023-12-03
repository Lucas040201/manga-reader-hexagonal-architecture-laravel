<?php

namespace App\Adapters\Queue\User;

use App\Constants\QueueNames;
use App\Services\RabbitMQService;
use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\SendVerificationEmailOutputPort;

class SendVerificationEmailUserAdapter implements SendVerificationEmailOutputPort
{

    public function __construct(
        private readonly RabbitMQService $rabbitMQService
    )
    {
    }

    public function sendEmail(UserEntity $user): void
    {
        $this->rabbitMQService->publish(
            QueueNames::SEND_VERIFY_EMAIL_QUEUE,
            [
                'email' => $user->getEmail(),
            ]
        );
    }
}
