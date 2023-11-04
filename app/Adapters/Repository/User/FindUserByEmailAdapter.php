<?php

namespace App\Adapters\Repository\User;

use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\FindUserByEmailOutputPort;

class FindUserByEmailAdapter extends UserBaseAdapter implements FindUserByEmailOutputPort
{

    /**
     * @throws \Exception
     */
    public function findUserByEmail(string $email): UserEntity|null
    {
        return $this->repository->findBy('email', $email);
    }
}
