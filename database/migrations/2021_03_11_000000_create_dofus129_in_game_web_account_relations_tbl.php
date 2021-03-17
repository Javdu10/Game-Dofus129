<?php

use Azuriom\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDofus129InGameWebAccountRelationsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dofus129_in_game_web_account_relations', function($table){
            $table->increments('id');
            $table->unsignedInteger('azuriom_id');
            $table->unsignedInteger('dofus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dofus129_in_game_web_account_relations');
    }
}
