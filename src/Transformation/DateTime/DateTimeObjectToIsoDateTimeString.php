<?php declare(strict_types=1);

namespace Apperapi\Transformation\DateTime;

use Apperapi\Transformation\Transformer;
use Apperapi\Validation\Rule\DateTime\ValidString;

final class DateTimeObjectToIsoDateTimeString implements Transformer
{
    /**
     * @param \DateTimeInterface $value
     * @return string
     */
    public function out(mixed $value): mixed
    {
        return $value->format('c');
    }

    /**
     * @param string $value
     */
    public function in(mixed $value): \DateTimeImmutable
    {
        $validationResult = (new ValidString())->validate($value);

        if (!$validationResult->isValid()) {
            throw new InvalidValue($validationResult->getErrors()[0]->getMessage());
        }

        return new \DateTimeImmutable($value);
    }
}
