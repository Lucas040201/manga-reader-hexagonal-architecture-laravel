<?php

namespace App\Adapters\Repository\User;

use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\FindUserByUsernameOutputPort;

class FindUserByUserNameAdapter extends UserBaseAdapter implements FindUserByUsernameOutputPort
{
    /**
     * @throws \Exception
     */
    public function findUserByUsername(string $username): UserEntity|null
    {
        return $this->repository->findBy('username', $username);
    }
}
