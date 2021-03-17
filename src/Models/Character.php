<?php

namespace Azuriom\Plugin\Dofus129\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Character extends Model
{
    protected $connection = 'dofus_characters';

    public function getTable()
    {
        return setting('dofus129_characters_tableName') ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public function getKeyName()
    {
        return setting('dofus129_characters_primaryKey') ?? $this->primaryKey;
    }

    public function getNameAttribute()
    {
        return $this->attributes[setting('dofus129_characters_nameCol')];
    }

    public function getLevelAttribute()
    {
        return $this->attributes[setting('dofus129_characters_levelCol')];
    }

    public function getExperienceAttribute()
    {
        return $this->attributes[setting('dofus129_characters_experienceCol')];
    }

    public function getHonorAttribute()
    {
        return $this->attributes[setting('dofus129_characters_honorCol')];
    }

    public function getAlignementAttribute()
    {
            $name = $this->attributes[setting('dofus129_characters_alignementCol')];

        return plugin_asset('dofus129', "img/icones/$name.png");
    }

    public function getAvatarAttribute()
    {
            $sexe = $this->attributes[setting('dofus129_characters_sexeCol')] == 0 ? 'm' : 'f';
            $class = $this->attributes[setting('dofus129_characters_classCol')];
            $name = $class.'_'.$sexe;

        return plugin_asset('dofus129', "img/$name.png");
    }
}