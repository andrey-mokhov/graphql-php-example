<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use Andi\GraphQL\Attribute\QueryField;
use App\Domain\User\Entity\User;

final class UserService
{
    #[QueryField(description: 'Returns the profile of the first astronaut')]
    public function getFirstAstronaut(): User
    {
        return new User('Yuri', 'Alekseyevich', 'Gagarin');
    }

    #[QueryField(description: 'Returns the profile of the first man on moon')]
    public function getFirstManOnTheMoon(): User
    {
        return new User('Neil', 'Alden', 'Armstrong');
    }
}
