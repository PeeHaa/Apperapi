<?php declare(strict_types=1);

namespace Apperapi\Entity;

use Apperapi\Annotation\Transforms;
use Apperapi\Transformation\DateTime\DateTimeObjectToIsoDateTimeString;

final class User
{
    private ?int $id = null;

    private string $firstName = 'John';

    private string $lastName = 'Doe';

    private string $emailAddress = 'johndoe@example.com';

    #[Transforms(DateTimeObjectToIsoDateTimeString::class)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
