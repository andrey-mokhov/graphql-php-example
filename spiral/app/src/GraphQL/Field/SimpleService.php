<?php

declare(strict_types=1);

namespace App\GraphQL\Field;

use Andi\GraphQL\Attribute\Argument;
use Andi\GraphQL\Attribute\MutationField;
use Andi\GraphQL\Attribute\QueryField;
use App\GraphQL\Type\AnimalEnum;
use App\GraphQL\Type\DirectionEnum;
use App\GraphQL\Type\User;
use App\GraphQL\Type\UserInterface;

final class SimpleService
{
    #[QueryField(name: 'echo')]
    #[MutationField(name: 'echo')]
    public function echoMessage(#[Argument] string $message): string
    {
        return 'echo: ' . $message;
    }

    #[QueryField]
    public function getUser(): UserInterface
    {
        return new User('Gagarin', 'Yuri', 'Alekseyevich');
    }

    #[MutationField]
    public function login(#[Argument(type: 'LoginRequest')] array $input): ?User
    {
        if ('yuri' === $input['login']) {
            return new User('Gagarin', 'Yuri', 'Alekseyevich');
        }

        return null;
    }

    #[QueryField]
    public function inverseDirection(#[Argument] DirectionEnum $direction): DirectionEnum
    {
        return $direction === DirectionEnum::asc
            ? DirectionEnum::desc
            : DirectionEnum::asc;
    }

    #[QueryField(type: 'Animal')]
    public function inverseAnimal(#[Argument(type: AnimalEnum::class)] int $animal): int
    {
        return AnimalEnum::DOG === $animal
            ? AnimalEnum::CAT
            : AnimalEnum::DOG;
    }
}
