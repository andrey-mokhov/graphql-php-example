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
    public readonly bool $isFirstAstronaut;

    #[ObjectField(description: 'This is Armstrong?')]
    public readonly bool $isFirstManOnTheMoon;

    public function __construct(
        #[ObjectField] private readonly string $firstname,
        private readonly string $middlename,
        #[ObjectField] private readonly string $lastname,
    ) {
        $this->isFirstAstronaut = (
                'Yuri' === $this->firstname
                && 'Alekseyevich' === $this->middlename
                && 'Gagarin' === $this->lastname
            ) || ( // on Russian
                'Юрий' === $this->firstname
                && 'Алексеевич' === $this->middlename
                && 'Гагарин' === $this->lastname
            );

        $this->isFirstManOnTheMoon = (
                'Neil' === $this->firstname
                && 'Alden' === $this->middlename
                && 'Armstrong' === $this->lastname
            ) || ( // on Russian
                'Нил' === $this->firstname
                && 'Олден' === $this->middlename
                && 'Армстронг' === $this->lastname
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
