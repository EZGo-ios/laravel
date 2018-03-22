<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_option extends Model
{
    protected $table ='question_option';
    public $timestamps = false;
    
    protected $fillable = [
        'question_id', 'option_id', 'qOption'
    ];

    
}
