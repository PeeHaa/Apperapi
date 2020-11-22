<?php declare(strict_types=1);

namespace Apperapi\Transformation;

use Apperapi\Exception;

final class InvalidValue extends Exception
{
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public static function invalidDataType(string $expectedType, mixed $value): self
    {
        return new self(
            sprintf('Expected type of %s instead got %s', $expectedType, get_debug_type($value)),
        );
    }

    public static function invalidData(mixed $value): self
    {
        return new self(
            sprintf('Encounterd invalid data %s', self::convertDataToString($value)),
        );
    }

    private static function convertDataToString(mixed $value): string
    {
        return match(gettype($value)) {
            'integer'  => (string) $value,
            'double'   => (string) $float,
            'boolean'  => $value ? 'TRUE' : 'FALSE',
            'string'   => sprintf('"%s"', $value),
            'array'    => json_encode($value),
            'NULL'     => 'NULL',
            'object'   => serialize($value),
            'resource' => get_debug_type($value),
        };
    }
}
