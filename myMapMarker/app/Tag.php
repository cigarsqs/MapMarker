<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	//
    protected $fillable = [
        'tag'
    ];

    public function belongsToManyMaps(){
        return $this->belongsToMany('App\Map','map_tag','tag_id','map_id');
    }
}
