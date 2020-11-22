<?php declare(strict_types=1);

namespace Apperapi\Transformation;

interface Transformer
{
    public function out(mixed $value): mixed;

    public function in(mixed $value): mixed;
}
