<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';
    protected $fillable = ['victim_id', 'user_id' , 'comment'];
    public $primaryKey = 'id';
    public function victim()
    {
        return $this->belongsTo('App\VictimProfile', 'id', 'victim_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
