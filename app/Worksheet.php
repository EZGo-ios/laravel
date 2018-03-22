<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    protected $table ='worksheet';
    public $timestamps = false;
    protected $primaryKey = 'worksheet_id';

    public function question(){
    	return $this->hasMany('App\Question', 'worksheet_id');
    }
}
