<?php

namespace App\Adapters\Repository\User;

use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\InsertUserOutputPort;

class InsertUserAdapter extends UserBaseAdapter implements InsertUserOutputPort
{
    /**
     * @throws \Exception
     */
    public function create(UserEntity $user): UserEntity
    {
        return $this->repository->create($user);
    }
}
