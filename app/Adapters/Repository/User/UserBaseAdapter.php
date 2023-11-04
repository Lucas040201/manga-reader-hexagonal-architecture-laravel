<?php

namespace App\Adapters\Repository\User;

use App\Repositories\User\UserRepository;

abstract class UserBaseAdapter
{
    public function __construct(
        protected readonly UserRepository $repository
    )
    {
    }
}
