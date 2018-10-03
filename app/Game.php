<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';

    protected $fillable = ['game_details'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
