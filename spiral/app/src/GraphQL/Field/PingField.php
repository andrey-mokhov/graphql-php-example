<?php

declare(strict_types=1);

namespace App\GraphQL\Field;

use Andi\GraphQL\Definition\Field\ResolveAwareInterface;
use Andi\GraphQL\Definition\Field\TypeAwareInterface;
use Andi\GraphQL\Field\QueryFieldInterface;
use GraphQL\Type\Definition as Webonyx;
use GraphQL\Type\Definition\StringType;

final class PingField implements QueryFieldInterface, ResolveAwareInterface
{
    public function getName(): string
    {
        return 'ping';
    }

    public function getDescription(): ?string
    {
        return null;
    }

    public function getDeprecationReason(): ?string
    {
        return null;
    }

    public function getType(): string
    {
        return StringType::class;
    }

    public function getTypeMode(): int
    {
        return TypeAwareInterface::IS_REQUIRED;
    }

    public function resolve(mixed $objectValue, array $args, mixed $context, Webonyx\ResolveInfo $info): mixed
    {
        return 'pong: ' . (new \DateTimeImmutable())->format(\DateTimeImmutable::ATOM);
    }
}
