<?php declare(strict_types=1);

namespace Apperapi\Validation\Rule\Combinator;

use Apperapi\Validation\Result;
use Apperapi\Validation\Rule;

final class All implements Rule
{
    public function __construct(private Rule ...$rules) {}

    public function validate(mixed $value): Result
    {
        $errors = [];

        foreach ($this->rules as $rule) {
            $result = $rule->validate($value);

            if ($result->isValid()) {
                continue;
            }

            $errors += $result->getErrors();
        }

        if ($errors) {
            return Result::failWithErrors(...$errors);
        }

        return Result::succeed();
    }
}
