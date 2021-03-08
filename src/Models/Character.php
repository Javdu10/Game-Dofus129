<?php

namespace Azuriom\Plugin\Dofus129\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Character extends Model
{
    protected $connection = 'dofus';

    public function getDatabaseName()
    {
        return setting('dofus129_characters_databaseName') ?? config('database.connections.dofus.database');
    }

    public function getTable()
    {
        return setting('dofus129_characters_tableName') ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public function getKeyName()
    {
        return setting('dofus129_characters_primaryKey') ?? $this->primaryKey;
    }

    public function getForeignKey()
    {
        return setting('dofus129_characters_foreignKey') ?? Str::snake(class_basename($this)).'_'.$this->getKeyName();
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

    public function getNameAttribute()
    {
        return $this->attributes[setting('dofus129_accounts_nameCol') ?? 'name'];
    }

    public function getLevelAttribute()
    {
        return $this->attributes[setting('dofus129_accounts_levelCol') ?? 'level'];
    }

    public function getExperienceAttribute()
    {
        return $this->attributes[setting('dofus129_accounts_experienceCol') ?? 'xp'];
    }

    public function getHonorAttribute()
    {
        try {
            $honor = $this->attributes[setting('dofus129_accounts_honorCol') ?? 'honor'];
        } catch (\Throwable $th) {
            $honor = 'error';
        }
        return $honor;
    }

    public function getAlignementAttribute()
    {
        try {
            $name = $this->attributes[setting('dofus129_accounts_alignementCol') ?? 'alignement'];
        } catch (\Throwable $th) {
            $name = 'none';
        }
        return plugin_asset('dofus129', "img/icones/$name.png");
    }

    public function getAvatarAttribute()
    {
        try {
            $sexe = $this->attributes[setting('dofus129_accounts_sexeCol') ?? 'sexe'] == 0 ? 'm' : 'f';
            $class = $this->attributes[setting('dofus129_accounts_classCol') ?? 'class'];
            $name = $class.'_'.$sexe;
        } catch (\Throwable $th) {
            $name = 'none';
        }

        return plugin_asset('dofus129', "img/$name.png");
    }
}