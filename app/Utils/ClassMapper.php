<?php

namespace App\Utils;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use Core\Domain\Base\Interfaces\EntityInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use ReflectionProperty;

class ClassMapper
{
    static private function arrayToClass(array $data, string $className): EntityInterface
    {
        return new $className(...$data);
    }

    /**
     * @throws Exception
     */
    static private function modelToEntity(string $className, Model $model): EntityInterface
    {
        $data = $model->toArrayCamelCase();

        $entity = new $className();

        foreach ($data as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            if(!method_exists($className, $methodName)) {
                throw new Exception("Property '{$methodName}' was Not Found", 500);
            }

            if('uuid' === $key && $value instanceof Uuid) {
                $data['uuid'] = $data['uuid']->toString();
            }

            $entity->$methodName($value);
        }

        return $entity;
    }

    /**
     * @throws Exception
     * @throws ClassNotFoundException
     * @throws GenerateEntityException
     */
    static function getEntity(string $className, ?array $data, ?Model $model): EntityInterface
    {
        if(!class_exists($className)) {
            throw new ClassNotFoundException();
        }

        $class = null;

        if(!empty($data)) {
            $class = self::arrayToClass($data, $className);
        } elseif(!empty($model)) {
            $class = self::modelToEntity($className, $model);
        }
        if(empty($class)) {
            throw new GenerateEntityException();
        }

        return $class;
    }

    /**
     * @throws Exception
     */
    static function getArrayFromEntity(EntityInterface $entity): array
    {
        $reflectedClass = new ReflectionClass($entity);
        $properties = $reflectedClass->getProperties(ReflectionProperty::IS_PRIVATE);
        $formattedData = [];

        foreach ($properties as $property) {
            $methodName = 'get' . ucfirst($property->getName());
            if(!method_exists($entity, $methodName)) {
                throw new Exception("Property '{$methodName}' was Not Found", 500);
            }

            $propertyValue = $entity->$methodName();

            if(empty($propertyValue)) {
                continue;
            }

            $formattedData[Str::snake($property->getName())] = $propertyValue;
        }

        return $formattedData;
    }
}
