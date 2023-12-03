<?php

namespace App\Adapters\Repository\User\PasswordRecoveryRequest;

use Core\Domain\Users\Entity\PasswordRecoveryEntity;
use Core\Domain\Users\Ports\Out\FindPasswordRecoveryByTokenOutputPort;

class FindPasswordRecoveryByTokenAdapter extends PasswordRecoveryRequestBaseRepositoryAdapter implements FindPasswordRecoveryByTokenOutputPort
{
    /**
     * @throws Exception
     */
    public function find(string $token): PasswordRecoveryEntity|null
    {
        return $this->repository->findBy('token', $token);
    }
}
