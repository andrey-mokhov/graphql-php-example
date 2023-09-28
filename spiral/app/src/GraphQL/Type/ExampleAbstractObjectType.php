<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use Andi\GraphQL\Attribute\AdditionalField;
use Andi\GraphQL\Attribute\Argument;
use Andi\GraphQL\Definition\Field\TypeAwareInterface;
use Andi\GraphQL\Definition\Type\ResolveFieldAwareInterface;
use Andi\GraphQL\Type\AbstractObjectType;
use App\GraphQL\Field\UserFullName;
use GraphQL\Type\Definition as Webonyx;
use GraphQL\Type\Definition\ResolveInfo;

final class ExampleAbstractObjectType extends AbstractObjectType implements ResolveFieldAwareInterface
{
    protected string $name = 'ExampleAbstractObjectType';

    protected iterable $fields = [
        'lastname' => 'String',
        'firstname' => [
            'type' => 'String',
            'typeMode' => TypeAwareInterface::IS_REQUIRED,
            'description' => 'User firstname',
            'resolve' => [self::class, 'getFirstname'],
        ],
        'displayName' => [
            'type' => 'String',
            'typeMode' => TypeAwareInterface::IS_REQUIRED,
            'resolve' => 'getDisplayName',
            'deprecationReason' => 'Do not define Resolver with only method name, use callable structure',
            'arguments' => [
                'flag' => 'Boolean',
                'foo' => [
                    'type' => 'String',
                    'typeMode' => TypeAwareInterface::IS_REQUIRED,
                    'defaultValue' => ' ',
                ],
            ],
        ],
    ];

    public function __construct()
    {
        $this->fields[] = new Webonyx\FieldDefinition([
            'name' => 'webonyxField',
            'type' => Webonyx\Type::nonNull(Webonyx\Type::string()),
            'resolve' => fn () => 'webonyxField resolved',
        ]);

        $this->fields[] = new UserFullName();
    }

    protected iterable $interfaces = [
        FullNameAwareInterface::class,
    ];

    private function getFirstname(User $user): string
    {
        return $user->getFirstname();
    }

    private function getDisplayName(User $user): string
    {
        return $user->getDisplayName();
    }

    public function resolveField(mixed $value, array $args, mixed $context, ResolveInfo $info): mixed
    {
        /** @var User $value */
        return match ($info->fieldName) {
            'lastname' => $value->getLastname(),
            default => null,
        };
    }

    #[AdditionalField(targetType: self::class)]
    public function echoMessage(#[Argument] string $message): string
    {
        return 'example: ' . $message;
    }
}
