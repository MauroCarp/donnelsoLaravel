<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tariff;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return response(json_encode($request->dniOriginal),200);

        $student = Student::where('dni',$request->dniOriginal)->first();

        if($request->type == 'dni'){
           $student->dni = $request->dni; 
        }

        if($request->type == 'phone'){
            $student->phone = is_null($request->studentPhone) ? '' : $request->studentPhone ;
            $student->fatherPhone = is_null($request->fatherPhone) ? '' : $request->fatherPhone ;
            $student->motherPhone = is_null($request->motherPhone) ? '' : $request->motherPhone ;
            $student->guardianPhone = is_null($request->guardianPhone) ? '' : $request->guardianPhone ;
        }

        $student->save();

            return response('ok',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function validateData()
    {
        $students = Student::all();

        $dataToValidate = array();

        foreach ($students as $key => $student) {

            if(strlen($student->dni) > 8 || strlen($student->phone) > 10){

                $validateDni = strlen($student->dni) > 8 ? true : false;
                $validatePhone = strlen($student->phone) > 10 ? true : false;

                $dataToValidate[$student->dni] = array('phone'=>array('validate'=> $validatePhone,'phone'=>$student->phone),
                                                       'dni'=>array('validate'=> $validateDni,'dni'=>$student->dni));

            }

        }
        return view('home',['dataToValidate'=>$dataToValidate]);


    }

    public function excelImport(Request $request)
    {
        if($request->hasFile('excelStudents')){

            $path = $request->file('excelStudents')->getRealPath();

            Excel::import(new StudentsImport, $path);
        
            return redirect('/')->with('success', 'All good!');
        }
    }

    public function importarPagos(Request $request)
    {
        if($request->hasFile('excelStudents')){

            $path = $request->file('excelStudents')->getRealPath();

            $spreadsheet = IOFactory::load($path);

            $worksheet = $spreadsheet->getActiveSheet();
            
            $highestRow = $worksheet->getHighestRow();

            // OBTENER LOS COSTOS PARA CALCULAR EL MONTO QUE 
            
            for ($row = 2; $row <= $highestRow; ++$row) {

                $dni = $worksheet->getCell('J'.$row)->getValue();
                $student = Student::where('dni',$dni)->first();

                $mar = $worksheet->getCell('L'.$row)->getValue();
                $apr = $worksheet->getCell('M'.$row)->getValue();
                $may = $worksheet->getCell('N'.$row)->getValue();
                $jun = $worksheet->getCell('O'.$row)->getValue();
                $jul = $worksheet->getCell('P'.$row)->getValue();
                $aug = $worksheet->getCell('Q'.$row)->getValue();
                $sep = $worksheet->getCell('R'.$row)->getValue();
                $oct = $worksheet->getCell('S'.$row)->getValue();
                $nov = $worksheet->getCell('T'.$row)->getValue();
                $dic = $worksheet->getCell('U'.$row)->getValue();

                StudentsController::payment($mar,$student->course,$student->id);
                StudentsController::payment($apr,$student->course,$student->id);
                StudentsController::payment($may,$student->course,$student->id);
                StudentsController::payment($jun,$student->course,$student->id);
                StudentsController::payment($jul,$student->course,$student->id);
                StudentsController::payment($aug,$student->course,$student->id);
                StudentsController::payment($sep,$student->course,$student->id);
                StudentsController::payment($oct,$student->course,$student->id);
                StudentsController::payment($nov,$student->course,$student->id);
                StudentsController::payment($dic,$student->course,$student->id);
             
            }

            die;
            return redirect('/')->with('success', 'All good!');
        }
    }

    public static function payment($month,$course,$id)
    {

        if(strlen($month) > 1 && !is_null($month) && $month != 'era flia'){

            $pattern = '/^(\S+)\s+([\d\/]+)\s+(\S+)$/';

            if (preg_match($pattern, $month, $matches)) {
                
                $part1 = $matches[1]; // 'P'
                $date = $matches[2]; // '10/3'
                $type = $matches[3]; // 'E'
                
                $date = date('Y-m-d',strtotime(str_replace('/','-',$date).'-2023'));

                $costoCuota = Tariff::where('course',$course)
                ->where('period','<=',$date)->first();

                $fecha1 = new DateTime('2023-03-01');
                $fecha2 = new DateTime($date);
                
                $diferencia = $fecha1->diff($fecha2);
                
                $mount = $costoCuota->mount;

                if($diferencia->format('%R%a días') > 10){

                    $mount = $costoCuota->expiredMount;

                }

                Payment::create([
                    'idStudent'=>$id,
                    'installments'=>'2023-03-01',
                    'mount'=>$mount,
                    'date'=>$date,
                    'type'=>$type
                ]);

            }

        }

    }
}
