<?php

namespace App\Repositories\User;

use App\Models\PasswordRecoveryRequest;
use App\Repositories\Base\RepositoryBase;
use Core\Domain\Users\Entity\PasswordRecoveryEntity;

class PasswordRecoveryRequestRepository extends RepositoryBase
{
    public function __construct(PasswordRecoveryRequest $passwordRecoveryRequestModel)
    {
        parent::__construct($passwordRecoveryRequestModel, PasswordRecoveryEntity::class);
    }
}
