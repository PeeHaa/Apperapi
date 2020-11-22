<?php declare(strict_types=1);

namespace Apperapi\Bin;

require_once __DIR__ . '/../vendor/autoload.php';

$user = new \Apperapi\Entity\User();

$serializer = new \Apperapi\Serialization\ArraySerializer();

$array = $serializer->serialize($user);

var_dump($array);

$array['firstName'] = 'Jane';

var_dump($serializer->unserialize($array, \Apperapi\Entity\User::class));
