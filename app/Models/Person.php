<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table='person';
    public function cars()
    {
        return $this->hasMany(Car::class,'person_id','id');
    }
    public function cellphones()
    {
        return $this->hasMany(CellPhone::class,'person_id','id');
    }
}
