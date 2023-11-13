<?php

namespace App\Imports;

use App\Models\Student;
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
        return new Student([
            'name'     => ucwords(strtolower($row[0])),
            'surname'    => ucwords(strtolower($row[1])), 
            'adress'    => ucwords(strtolower($row[3])), 
            'phone'    => ucwords(strtolower($row[4])), 
            'dni'    => ucwords(strtolower($row[9])), 
            'course'    => ucwords(strtolower($row[21])), 
            'schoolSchedule'    => ucwords(strtolower($row[8])), 
        ]);
    }
}
