<?php

namespace App\Adapters\Repository\User\PasswordRecoveryRequest;

use Core\Domain\Users\Entity\PasswordRecoveryEntity;
use Core\Domain\Users\Ports\Out\CreatePasswordRecoveryOutputPort;

class CreatePasswordRecoveryRequestAdapter extends PasswordRecoveryRequestBaseRepositoryAdapter implements CreatePasswordRecoveryOutputPort
{
    public function create(PasswordRecoveryEntity $passwordRecovery): PasswordRecoveryEntity
    {
        return $this->repository->create($passwordRecovery);
    }
}
