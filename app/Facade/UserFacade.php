<?php

namespace App\Facade;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use App\Models\User;
use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\In\InsertUserInputPort;
use Exception;

class UserFacade extends BaseFacade
{
    public function __construct(
        protected User $user,
        private readonly InsertUserInputPort $insertUserInputPort
    )
    {
        parent::__construct(
            $user,
            UserEntity::class
        );
    }

    /**
     * @throws Exception
     * @throws ClassNotFoundException
     * @throws GenerateEntityException
     */
    public function create(array $data): UserEntity
    {
        $user = $this->getEntity($data);
        return $this->insertUserInputPort->create($user);
    }

}
