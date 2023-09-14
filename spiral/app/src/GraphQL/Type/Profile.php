<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use Andi\GraphQL\Definition\Type\ObjectTypeInterface;
use Andi\GraphQL\Definition\Type\ResolveFieldAwareInterface;
use Andi\GraphQL\Field\AbstractObjectField;
use App\Domain\User\Entity\User;
use GraphQL\Type\Definition as Webonyx;

final class Profile implements ObjectTypeInterface, ResolveFieldAwareInterface
{
    public function getName(): string
    {
        return 'Profile';
    }

    public function getDescription(): ?string
    {
        return 'User profile';
    }

    public function getFields(): iterable
    {
        yield new Webonyx\FieldDefinition([
            'name' => 'firstname',
            'type' => Webonyx\Type::string(),
            'resolve' => static function (mixed $objectValue): mixed {
                if ($objectValue instanceof User) {
                    return (new \ReflectionClass($objectValue))->getProperty('firstname')->getValue($objectValue);
                }

                return $objectValue['firstname'] ?? null;
            },
        ]);

        yield new class extends AbstractObjectField {
            protected string $name = 'lastname';
            protected string $type = 'String'; // short GraphQL name or Name::class

            // field's value resolved in Profile::resolveField
        };
    }

    public function resolveField(mixed $value, array $args, mixed $context, Webonyx\ResolveInfo $info): mixed
    {
        $field = $info->fieldName;

        if ($value instanceof User) {
            return (new \ReflectionClass($value))->getProperty($field)->getValue($value);
        }

        return $value[$field] ?? null;
    }
}
