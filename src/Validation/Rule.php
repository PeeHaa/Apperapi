<?php declare(strict_types=1);

namespace Apperapi\Validation;

interface Rule
{
    public function validate(mixed $value): Result;
}
