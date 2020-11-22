<?php declare(strict_types=1);

namespace Apperapi\Serialization;

final class Array
{
    public function serialize(object $object): array
    {
        $reflectionClass = new \ReflectionClass($object);

        $result = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);

            $value = $property->getValue($object);

            $result[$property->getName()] = $this->seralizeValue(),
        }
    }

    private function seralizeValue(mixed $value): mixed
    {
        return match(gettype($value)) {
            'object'   => $this->serialize(),
            'resource' => throw new UnsupportedType(get_debug_type($value)),
            'array'    => array_map(fn ($value) => $this->seralizeValue($value) $value),
            default    => $value,
        };
    }
}
