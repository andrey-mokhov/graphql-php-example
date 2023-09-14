<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Andi\GraphQL\Attribute\ObjectField;
use Andi\GraphQL\Attribute\ObjectType;

/**
 * User data
 */
#[ObjectType]
final class User
{
    /**
     * This is Gagarin?
     */
    #[ObjectField]
    public readonly bool $isFirstCosmonaut;

    public function __construct(
        #[ObjectField] private readonly string $firstname,
        private readonly string $middlename,
        #[ObjectField] private readonly string $lastname,
    ) {
        $this->isFirstCosmonaut = (
                'Yuri' === $this->firstname
                && 'Alekseyevich' === $this->middlename
                && 'Gagarin' === $this->lastname
            ) || ( // on Russian
                'Юрий' === $this->firstname
                && 'Алексеевич' === $this->middlename
                && 'Гагарин' === $this->lastname
            );
    }

    #[ObjectField]
    public function getDisplayName(): string
    {
        return sprintf('%1$s %2$.1s. %3$s',
            $this->firstname,
            $this->middlename,
            $this->lastname,
        );
    }
}
