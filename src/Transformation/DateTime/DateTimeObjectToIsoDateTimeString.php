<?php declare(strict_types=1);

namespace Apperapi\Tranformation\DateTime;

use Apperapi\Validation\Rule\DateTime\ValidString;

final class DateTimeObjectToIsoDateTimeString implements Transformer
{
    /**
     * @return string
     */
    public function out(\DateTimeInterface $value): mixed
    {
        return $value->format('c');
    }

    /**
     * @param string $value
     */
    public function in(mixed $value): \DateTimeImmutable
    {
        $validationResult = (new ValidString($value))->validate();

        if (!$validationResult->isValid()) {
            throw new InvalidValue($validationResult->getErrors()[0]->getMessage());
        }

        return new \DateTimeImmutable($value);
    }
}
