<?php declare(strict_types=1);

namespace Apperapi\Validation;

final class Result
{
    private function __construct(private bool $valid, private Error ....$errors) {}

    public static function succeed(): self
    {
        return new self(true);
    }

    public static function fail(string $errorMessage): self
    {
        return new self(false, new Error($errorMessage));
    }

    public static function failWithErrors(Error ...$errors): self
    {
        return new self(false, ...$errors);
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @return array<int,Error>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
