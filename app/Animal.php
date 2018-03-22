<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    protected $table ='animal';
    public $timestamps = false;
    protected $primaryKey = 'animal_id';
    protected $fillable = [
        'animal_name','location_id'
    ];

    public function location(){
    	return $this->hasOne('App\Location', 'location_id', 'location_id');
    }

    public function question(){
        return $this->hasMany('App\Question', 'animal_id');
    }
}
