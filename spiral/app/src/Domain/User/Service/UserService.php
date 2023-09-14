<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use Andi\GraphQL\Attribute\QueryField;
use App\Domain\User\Entity\User;

final class UserService
{
    #[QueryField(description: 'Returns the profile of the first astronaut')]
    public function getFirstCosmonaut(): User
    {
        return new User('Yuri', 'Alekseyevich', 'Gagarin');
    }

    #[QueryField(type: 'Profile!')]
    public function getLegend(): User
    {
        return new User('Neil', 'Alden', 'Armstrong');
    }

    #[QueryField(type: 'Profile!')]
    public function getFirstManInOuterSpace(): array
    {
        return [
            'firstname' => 'Alexei',
            'middlename' => 'Arkhipovich',
            'lastname' => 'Leonov'
        ];
    }
}
