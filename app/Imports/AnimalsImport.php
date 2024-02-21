<?php

namespace App\Imports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class AnimalsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Animal([
            'type'=>$row[0],
            'caravan'=>(Str::contains($row[1], 'sc')) ? 'S/C ' . trim(str_replace('sc','',$row[1])) : $row[1],
            'age'=>$row[2],
            'sex'=>$row[3],
            'destination'=>(is_null($row[4])) ? 'engorde' : $row[4] 
        ]);
    }
}
