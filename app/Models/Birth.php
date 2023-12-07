<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birth extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mother(){

        return $this->belongsTo(Animal::class,'idMother','id');
        
    }
}
