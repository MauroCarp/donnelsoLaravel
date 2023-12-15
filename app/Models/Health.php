<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'idAnimal', 'id');
    }

}