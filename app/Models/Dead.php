<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dead extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dead(){

        return $this->belongsTo(Animal::class,'id','idDead');
        
    }
}
