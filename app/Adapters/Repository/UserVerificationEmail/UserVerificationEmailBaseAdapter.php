<?php

namespace App\Adapters\Repository\UserVerificationEmail;

use App\Repositories\User\UserVerificationEmailRepository;

abstract class UserVerificationEmailBaseAdapter
{
    public function __construct(
        protected readonly UserVerificationEmailRepository $repository
    )
    {
    }
}
