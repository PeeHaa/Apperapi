<?php declare(strict_types=1);

namespace Apperapi\Serialization;

use Apperapi\Annotation\Transforms;

final class ArraySerializer
{
    public function serialize(object $object): array
    {
        $reflectionClass = new \ReflectionClass($object);

        $result = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);

            $value = $property->getValue($object);

            $result[$property->getName()] = $this->seralizeValue($this->transformOut($property, $value));
        }

        return $result;
    }

    private function transformOut(\ReflectionProperty $property, mixed $value): mixed
    {
        foreach ($property->getAttributes(Transforms::class) as $transform) {
            $value = $transform->newInstance()->out($value);
        }

        return $value;
    }

    private function seralizeValue(mixed $value): mixed
    {
        return match(gettype($value)) {
            'object'   => $this->serialize($value),
            'resource' => throw new UnsupportedType(get_debug_type($value)),
            'array'    => array_map(fn ($value) => $this->seralizeValue($value), $value),
            default    => $value,
        };
    }

    public function unserialize(array $array, string $className): object
    {
        $reflectionClass = new \ReflectionClass($className);

        $instance = $reflectionClass->newInstance();

        foreach ($reflectionClass->getProperties() as $property) {
            if (!array_key_exists($property->getName(), $array)) {
                continue;
            }

            $property->setAccessible(true);

            $value = $property->setValue(
                $instance,
                $this->unseralizeValue($property, $this->transformIn($property, $array[$property->getName()])),
            );
        }

        return $instance;
    }

    private function transformIn(\ReflectionProperty $property, mixed $value): mixed
    {
        foreach ($property->getAttributes(Transforms::class) as $transform) {
            $value = $transform->newInstance()->in($value);
        }

        return $value;
    }

    private function unseralizeValue(\ReflectionProperty $reflectionProperty, mixed $value): mixed
    {
        return $value;
    }
}
