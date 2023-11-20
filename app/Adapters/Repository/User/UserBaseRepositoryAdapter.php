<?php

namespace App\Adapters\Repository\User;

use App\Adapters\Repository\RepositoryAdapterBase;
use App\Repositories\User\UserRepository;

abstract class UserBaseRepositoryAdapter extends RepositoryAdapterBase
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
