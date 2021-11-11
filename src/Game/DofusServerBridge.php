<?php

namespace Azuriom\Plugin\Dofus129\Game;

use Azuriom\Games\ServerBridge;
use Azuriom\Models\User;
use RuntimeException;
use Illuminate\Support\Facades\Storage;

class DofusServerBridge extends ServerBridge
{
    public function verifyLink()
    {
        return (bool) @fsockopen($this->server->address, $this->server->port, $errorno, $errorstr, 0.1);
    }

    public function canExecuteCommand()
    {
        return true;
    }

    public function getServerData()
    {
        return [
            'players' => 0,
            'max_players' => 0,
        ];
    }

    public function sendCommands(array $commands, User $user = null, bool $needConnected = false)
    {
        if ($user === null) {
            throw new RuntimeException('User is required to send commands.');
        }

        $context = stream_context_create(
            [
                'ssl'=>[
                    'local_cert'=> Storage::path('server.pem'),
                    "verify_peer_name"=>false,
                    'allow_self_signed' => true
                ]
            ]
        );

        $timeout = 1; // seconds
        $socket = stream_socket_client('ssl://'.$this->server->address.':'.$this->server->port,
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (! $socket) {
            throw new RuntimeException("{$errstr} ({$errno})");
        }

        $idPlayer = session('m_idPlayer');

        if (empty($idPlayer)) {
            $characters = dofus_characters($user->id);
            $idPlayer = $characters[0]->getKey();
        }

        foreach ($commands as $command) {
            $tmp = str_replace('{player}', $idPlayer, $command);
            $tmp .= "\n";
            fwrite($socket, $tmp, strlen($tmp));
        }

        if ($socket) {
            fclose($socket);
        }
    }
}
