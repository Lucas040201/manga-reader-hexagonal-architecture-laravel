<?php

namespace App\Facade;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use App\Utils\ClassMapper;
use Core\Domain\Base\Interfaces\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseFacade
{
    public function __construct(
        protected Model $model,
        protected string $entity
    )
    {
    }

    /**
     * @throws Exception
     * @throws ClassNotFoundException
     * @throws GenerateEntityException
     */
    protected function getEntity(?array $data): EntityInterface
    {
        return ClassMapper::getEntity($this->entity, $data, $this->model);
    }

}
