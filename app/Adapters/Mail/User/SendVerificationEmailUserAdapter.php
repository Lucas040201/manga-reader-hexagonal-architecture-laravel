<?php

namespace App\Adapters\Mail\User;

use App\Mail\User\UserVerifyEmail;
use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Entity\UserVerificationEmailEntity;
use Core\Domain\Users\Ports\Out\SendVerificationEmailOutputPort;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmailUserAdapter implements SendVerificationEmailOutputPort
{

    public function sendEmail(UserEntity $user, UserVerificationEmailEntity $userVerificationEmailEntity): void
    {
        Mail::to($user->getEmail())->send(new UserVerifyEmail($userVerificationEmailEntity));
    }
}
