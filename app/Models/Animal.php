<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public function mother()
    {
        
        return $this->hasOne(Birth::class,'id','idMother');
        

    }

    public function dead()
    {
        
        return $this->hasOne(Dead::class,'id','idDead');
        

    }

    public function health()
    {
        
        return $this->belongsTo(Health::class,'id','idAnimal');
        

    }
}
