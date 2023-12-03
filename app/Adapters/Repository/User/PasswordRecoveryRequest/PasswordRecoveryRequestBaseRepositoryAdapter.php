<?php

namespace App\Adapters\Repository\User\PasswordRecoveryRequest;

use App\Adapters\Repository\RepositoryAdapterBase;
use App\Repositories\User\PasswordRecoveryRequestRepository;

abstract class PasswordRecoveryRequestBaseRepositoryAdapter extends RepositoryAdapterBase
{
    public function __construct(PasswordRecoveryRequestRepository $repository)
    {
        parent::__construct($repository);
    }
}
