<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VictimProfile extends Model
{
    public $table = 'victim_profiles';
    protected $fillable = ['type', 'description','height','gender','victim_image','victimcurrentlat','victimcurrentlon','ffname','ffcontact'];
    public $primaryKey = 'id';
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function sawvictim()
    {
        return $this->belongsTo('App\Saw');
    }
}
