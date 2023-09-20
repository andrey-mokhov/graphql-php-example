<?php

declare(strict_types=1);

namespace App\GraphQL\Field;

use Andi\GraphQL\Attribute\Argument;
use Andi\GraphQL\Attribute\MutationField;
use Andi\GraphQL\Attribute\QueryField;
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
}
