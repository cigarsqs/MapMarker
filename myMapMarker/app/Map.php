<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model {

	//
    protected $fillable = [
        'id',
        'title',
        'context',
        'is_public',
        'published_at',
        'user_id'
    ];

    public function belongToUser(){
        return $this->belongsTo('App\User','user_id');
    }

    public function belongsToManyTags(){
        return $this->belongsToMany('App\Tag','map_tag','map_id','tag_id');
    }
}
