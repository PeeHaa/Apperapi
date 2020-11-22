<?php declare(strict_types=1);

namespace Apperapi\Validation;

final class Error
{
    private function __construct(private string $message) {}

    public function getMessage(): string
    {
        return $this->message;
    }
}
