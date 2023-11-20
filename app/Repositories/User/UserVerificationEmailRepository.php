<?php

namespace App\Repositories\User;

use App\Models\UserVerificationEmail;
use App\Repositories\Base\RepositoryBase;
use Core\Domain\Users\Entity\UserVerificationEmailEntity;

class UserVerificationEmailRepository extends RepositoryBase
{
    public function __construct(UserVerificationEmail $verificationEmailModel)
    {
        parent::__construct($verificationEmailModel, UserVerificationEmailEntity::class);
    }
}
