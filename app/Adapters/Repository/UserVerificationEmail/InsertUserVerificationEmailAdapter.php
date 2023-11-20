<?php

namespace App\Adapters\Repository\UserVerificationEmail;

use Core\Domain\Users\Entity\UserVerificationEmailEntity;
use Core\Domain\Users\Ports\Out\InsertUserVerificationEmailOutputPort;

class InsertUserVerificationEmailAdapter extends UserVerificationEmailBaseAdapter implements InsertUserVerificationEmailOutputPort
{
    public function create(UserVerificationEmailEntity $userVerificationEmailEntity): UserVerificationEmailEntity
    {
        return $this->repository->create($userVerificationEmailEntity);
    }
}
