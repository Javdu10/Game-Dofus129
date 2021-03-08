<?php

namespace Azuriom\Plugin\Dofus129\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'dofus';

    public function getDatabaseName()
    {
        return setting('dofus129_accounts_databaseName') ?? config('database.connections.dofus.database');
    }

    public function getTable()
    {
        return setting('dofus129_accounts_tableName') ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public function getKeyName()
    {
        return setting('dofus129_accounts_primaryKey') ?? $this->primaryKey;
    }

    public function getForeignKey()
    {
        return setting('dofus129_accounts_foreignKey') ?? Str::snake(class_basename($this)).'_'.$this->getKeyName();
    }

    public function getConnection()
    {
        $database = config('database.connections.dofus.database');
        config(['database.connections.dofus.database' => $this->getDatabaseName()]);
        DB::purge('dofus');

        $connection = static::resolveConnection($this->getConnectionName());
        config(['database.connections.dofus.database' => $database]);

        return $connection;
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}