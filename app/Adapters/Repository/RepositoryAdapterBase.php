<?php

namespace App\Adapters\Repository;

use App\Repositories\Base\RepositoryBase;

abstract class RepositoryAdapterBase
{
    public function __construct(
        protected readonly RepositoryBase $repository
    )
    {
    }
}
