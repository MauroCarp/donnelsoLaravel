<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return array(
            'marzo'      => $row[11],
            'abril'       => $row[12], 
            'mayo'       => $row[13], 
            'junio'      => $row[14], 
            'julio'      => $row[15], 
            'agosto'     => $row[16], 
            'septiembre' => $row[17], 
            'octubre'    => $row[18], 
            'noviembre'  => $row[19], 
            'diciembre'  => $row[20], 
        );
    }

    
}
