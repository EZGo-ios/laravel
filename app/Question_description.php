<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_description extends Model
{
    protected $table ='question_description';
    public $timestamps = false;
    protected $primaryKey = 'description_id';
    protected $fillable = [
        'description'
    ];

    public function question(){
    	return $this->hasMany('App\Question', 'description_id');
    }
}
