<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saw extends Model
{
    //
    public $table = 'saws';
    public $fillable = ['user_id', 'victim_id'];
}
