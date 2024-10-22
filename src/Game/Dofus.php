<?php

namespace Azuriom\Plugin\Dofus129\Game;

use Azuriom\Games\Game;
use Azuriom\Models\User;

class Dofus extends Game
{
    public function name()
    {
        return 'Dofus 1.29';
    }

    public function id()
    {
        return 'dofus129';
    }

    public function getAvatarUrl(User $user, int $size = 64): string
    {
        return 'https://www.gravatar.com/avatar/'.md5($user->email ?? '').'?d=mp&s='.$size;
    }

    public function getUserUniqueId(string $name)
    {
        return $name;
    }

    public function getUserName(User $user)
    {
        return $user->name;
    }

    public function getSupportedServers()
    {
        return [
            'dofus-server' => DofusServerBridge::class,
        ];
    }
}
