<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Maps extends Model
{
    public $table = 'maps';

    protected $fillable = ['victim_id', 'lat','lon'];

    public function victim()
    {
        return $this->belongsTo('App\VictimProfile');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', "id");
    }
}
