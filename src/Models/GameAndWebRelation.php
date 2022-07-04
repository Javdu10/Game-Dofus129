<?php

namespace Azuriom\Plugin\Dofus129\Models;

use Illuminate\Database\Eloquent\Model;

class GameAndWebRelation extends Model
{
    public $timestamps = false;

    protected $table = 'dofus129_in_game_web_account_relations';

    protected $fillable = ['azuriom_id', 'dofus_id'];

    public function characters()
    {
        return $this->hasMany(Character::class, setting('dofus129_accounts_foreignKey'), 'dofus_id');
    }

    public function account()
    {
        return $this->hasOne(Account::class, setting('dofus129_accounts_primaryKey'), 'dofus_id');
    }
}
