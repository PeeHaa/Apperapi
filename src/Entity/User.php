<?php declare(strict_types=1);

namespace Apperapi\Entity;

use Apperapi\Tranformation\DateTime\DateTimeObjectToIsoDateTimeString;

final class User
{
    private ?int $id = null;

    private string $firstName;

    private string $lastName;

    private string $emailAddress;

    #[DateTimeObjectToIsoDateTimeString]
    private DateTimeImmutable $createdAt;
}
