<?php

use Azuriom\Plugin\Dofus129\Models\GameAndWebRelation;

if (! function_exists('dofus_characters')) {
    function dofus_characters(int $azuriom_user_id)
    {
        $relations = GameAndWebRelation::with('characters')->where('azuriom_id', $azuriom_user_id)->get();

        return $relations->map(function ($relation) {
            return $relation->characters;
        })->flatten();
    }
}
