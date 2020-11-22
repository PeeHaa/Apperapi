<?php declare(strict_types=1);

namespace Apperapi\Serialization;

use Apperapi\Exception;

final class UnsupportedType extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct(
            sprintf('Could not serialize value of type %s', $type),
        );
    }
}
