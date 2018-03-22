<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table ='question';
    public $timestamps = false;
    protected $primaryKey = 'question_id';
    protected $fillable = [
        'worksheet_id', 'question_id','animal_id','description_id','question','answer'
    ];

    public function description(){
        return $this->belongsTo('App\Question_description', 'description_id');
    }

    public function worksheet(){
        return $this->belongsTo('App\Worksheet', 'worksheet_id');
    }

    public function animal(){
        return $this->belongsTo('App\Animal', 'animal_id');
    }
}
