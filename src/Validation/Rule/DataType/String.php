<?php declare(strict_types=1);

namespace Apperapi\Validation\Rule\DataType;

use Apperapi\Validation\Result;
use Apperapi\Validation\Rule;

final class String implements Rule
{
    public function validate(mixed $value): Result
    {
        if (!is_string($value)) {
            return Result::fail('Value must be a string');
        }

        return Result::succeed();
    }
}
