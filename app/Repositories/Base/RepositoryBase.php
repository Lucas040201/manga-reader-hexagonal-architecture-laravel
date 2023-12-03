<?php

namespace App\Repositories\Base;

use App\Utils\ClassMapper;
use Core\Domain\Base\Interfaces\EntityInterface;
use Illuminate\Database\Eloquent\Model;

Abstract class RepositoryBase
{

    public function __construct(
        protected readonly Model $model,
        protected readonly string $entity
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $entity = ClassMapper::getArrayFromEntity($entity);
        $resource = $this->model::create($entity);
        return ClassMapper::getEntity($this->entity, [], $resource);
    }

    /**
     * @throws \Exception
     */
    public function findBy(string $needle, mixed $value): EntityInterface | null
    {
        $resource = $this->model::firstWhere($needle, $value);

        if (empty($resource)) {
            return null;
        }

        return ClassMapper::getEntity($this->entity, [], $resource);
    }

    public function delete(string $needle, int $id)
    {
        return $this->model::where($needle, $id)->delete();
    }

    public function update(int $id, EntityInterface $entity): bool
    {
        $entity = ClassMapper::getArrayFromEntity($entity);
        return !!$this->model::where('id', $id)->update($entity);
    }

}
