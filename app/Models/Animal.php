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
}
