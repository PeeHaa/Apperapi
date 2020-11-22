<?php declare(strict_types=1);

namespace Apperapi\Validation\Rule\Combinator;

use Apperapi\Validation\Result;
use Apperapi\Validation\Rule;

final class All implements Rule
{
    public function __construct(private Rule ...$rules) {}

    public function validate(mixed $value): Result
    {
        $errors = array_reduce(
            $this->rules,
            fn (array $errors, Rule $rule) => array_merge($errors, $rule->validate($value)->getErrors()),
            [],
        );

        if ($errors) {
            return Result::failWithErrors(...$errors);
        }

        return Result::succeed();
    }
}
