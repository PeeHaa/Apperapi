<?php declare(strict_types=1);

namespace Apperapi\Validation\Rule\DateTime;

use Apperapi\Validation\Rule\Combinator\All;
use Apperapi\Validation\Rule\DataType\StringType;
use Apperapi\Validation\Result;
use Apperapi\Validation\Rule;

final class ValidString implements Rule
{
    public function validate(mixed $value): Result
    {
        $result = (new StringType())->validate($value);

        if (!$result->isValid()) {
            return $result;
        }

        if (strtotime($value) === false) {
            return Result::fail('Invalid date/time string');
        }

        return Result::succeed();
    }
}
