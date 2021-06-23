<?php

namespace Azuriom\Plugin\Dofus129\Game;

use Azuriom\Games\ServerBridge;
use Azuriom\Models\User;
use RuntimeException;

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

        $fp = fsockopen($this->server->address, $this->server->port, $errno, $errstr);
        if (! $fp) {
            throw new RuntimeException("{$errstr} ({$errno})");
        }

        $idPlayer = session('m_idPlayer');

        if (empty($idPlayer)) {
            $characters = \dofus_characters($user->id);
            $idPlayer = $characters[0]->getKey();
        }

        foreach ($commands as $command) {
            $tmp = \str_replace('{player}', $idPlayer, $command);
            $tmp = $this->xor_this($tmp)."\r\n";
            fwrite($fp, $tmp, \strlen($tmp));
        }

        if ($fp) {
            fclose($fp);
        }
    }

    /*
    * simple xor from https://stackoverflow.com/a/14673630
    */
    private function xor_this($string)
    {
        $key = setting('dofus129_azuriom_password', 'password');
        $text = $string;
        $outText = '';
        for ($i = 0; $i < strlen($text);) {
            for ($j = 0; ($j < strlen($key) && $i < strlen($text)); $j++,$i++) {
                $outText .= $text[$i] ^ $key[$j];
            }
        }

        return $outText;
    }
}
