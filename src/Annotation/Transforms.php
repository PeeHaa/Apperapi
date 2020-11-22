<?php declare(strict_types=1);

namespace Apperapi\Annotation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Transforms
{
    public function __construct(private string $transformer) {}

    public function out(mixed $value): mixed
    {
        return (new $this->transformer)->out($value);
    }

    public function in(mixed $value): mixed
    {
        return (new $this->transformer)->in($value);
    }
}
