<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table ='location';
    public $timestamps = false;
    protected $primaryKey = 'location_id';
    protected $fillable = [
        'lng','lat'
    ];

    public function animal(){
    	return $this->belongsTo('App\Animal', 'location_id', 'location_id');
    }
}
