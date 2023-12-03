<?php

namespace App\Facade;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use App\Models\User;
use Core\Domain\Users\Entity\UserEntity;
use Core\Domain\Users\Ports\In\ConfirmAccountInputPort;
use Core\Domain\Users\Ports\In\CreateUserInputPort;
use Core\Domain\Users\UseCases\CreatePasswordRecoveryUseCase;
use Exception;

class UserFacade extends BaseFacade
{
    public function __construct(
        protected User                                  $user,
        private readonly CreateUserInputPort            $createUserInputPort,
        private readonly ConfirmAccountInputPort        $confirmAccountInputPort,
        private readonly CreatePasswordRecoveryUseCase  $createPasswordRecoveryUseCase
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
        return $this->createUserInputPort->create($user);
    }

    public function confirmAccount(string $token): void
    {
        $this->confirmAccountInputPort->confirm($token);
    }

    public function recoverPassword(string $email)
    {
        $this->createPasswordRecoveryUseCase->create($email);
    }

}
