<?php

namespace Azuriom\Plugin\Dofus129\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'dofus_accounts';
    public $timestamps = false;

    public function getTable()
    {
        return setting('dofus129_accounts_tableName', $this->table);
    }

    public function getKeyName()
    {
        return setting('dofus129_accounts_primaryKey', $this->primaryKey);
    }

    public function getForeignKey()
    {
        return setting('dofus129_accounts_foreignKey');
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
