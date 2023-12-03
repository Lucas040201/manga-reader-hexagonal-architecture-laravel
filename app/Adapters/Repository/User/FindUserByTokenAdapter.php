<?php

namespace App\Adapters\Repository\User;

use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\FindUserByTokenOutputPort;
use Exception;

class FindUserByTokenAdapter extends UserBaseRepositoryAdapter implements FindUserByTokenOutputPort
{
    /**
     * @throws Exception
     */
    public function findUser(string $token): UserEntity|null
    {
        return $this->repository->findBy('token', $token);
    }
}
