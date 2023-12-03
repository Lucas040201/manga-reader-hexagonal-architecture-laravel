<?php

namespace App\Adapters\Repository\User;

use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\Out\UpdateUserOutputPort;

class UpdateUserAdapter extends UserBaseRepositoryAdapter implements UpdateUserOutputPort
{
    public function update(UserEntity $user): bool
    {
        return $this->repository->update($user->getId(), $user);
    }
}
