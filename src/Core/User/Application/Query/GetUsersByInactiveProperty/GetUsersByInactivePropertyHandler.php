<?php

namespace App\Core\User\Application\Query\GetUsersByInactiveProperty;

use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Domain\Repository\UserRepositoryInterface;
use App\Core\User\Domain\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetUsersByInactivePropertyHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(GetUsersByInactivePropertyQuery $query): array
    {
        $users = $this->userRepository->get();
        return array_map(function (User $user) {
            return new UserDTO(
                $user->getId(),
                $user->getEmail(),
                $user->getIsActive()
            );
        }, $users);
    }
}