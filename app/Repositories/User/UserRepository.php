<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\RepositoryBase;
use Core\Domain\Users\Entity\UserEntity;

class UserRepository extends RepositoryBase
{
    public function __construct(User $userModel)
    {
        parent::__construct($userModel, UserEntity::class);
    }
}
