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

                StudentsController::payment($mar,$student->course,$student->id,'2023-03-01');
                StudentsController::payment($apr,$student->course,$student->id,'2023-04-01');
                StudentsController::payment($may,$student->course,$student->id,'2023-05-01');
                StudentsController::payment($jun,$student->course,$student->id,'2023-06-01');
                StudentsController::payment($jul,$student->course,$student->id,'2023-07-01');
                StudentsController::payment($aug,$student->course,$student->id,'2023-08-01');
                StudentsController::payment($sep,$student->course,$student->id,'2023-09-01');
                StudentsController::payment($oct,$student->course,$student->id,'2023-10-01');
                StudentsController::payment($nov,$student->course,$student->id,'2023-11-01');
                StudentsController::payment($dic,$student->course,$student->id,'2023-12-01');
             
            }

            die;
            return redirect('/')->with('success', 'All good!');
        }
    }

    public static function payment($month,$course,$id,$installment)
    {

        if(strlen($month) > 1 && !is_null($month) && $month != 'era flia' && strlen($month) <= 9){

            $pattern = '/^(\S+)\s+([\d\/]+)\s+(\S+)$/';

            if (preg_match($pattern, $month, $matches)) {

                $part1 = $matches[1]; // 'P'
                $date = $matches[2]; // '10/3'
                $type = $matches[3]; // 'E'
                $datetmp = $date;
                $date = date('Y-m-d',strtotime(str_replace('/','-',$date).'-2023'));
                $costoCuota = Tariff::where('course',$course)
                ->where('period','<=',$date)->first();

                $fecha1 = new DateTime('2023-03-01');
                $fecha2 = new DateTime($date);
                
                $diferencia = $fecha1->diff($fecha2);

                if(is_null($costoCuota)){
                    dump($month);
                    dump($course);
                    dump($datetmp);
                    dump($date);
                    dump($id);
                    dump($installment);
                }
                $mount = $costoCuota->mount;

                if($diferencia->format('%R%a días') > 10){

                    $mount = $costoCuota->expiredMount;

                }

                Payment::create([
                    'idStudent'=>$id,
                    'installments'=>$installment,
                    'mount'=>$mount,
                    'date'=>$date,
                    'type'=>$type
                ]);

            }

        }

    }

    public function importStudents(Request $request)
    {
        if($request->hasFile('excelStudents')){

            $path = $request->file('excelStudents')->getRealPath();

            $spreadsheet = IOFactory::load($path);

            $worksheet = $spreadsheet->getActiveSheet();
            
            $highestRow = $worksheet->getHighestRow();

            // OBTENER LOS COSTOS PARA CALCULAR EL MONTO QUE 
            
            for ($row = 2; $row <= $highestRow; ++$row) {

                $surname = $worksheet->getCell('A'.$row)->getValue();
                $name = $worksheet->getCell('B'.$row)->getValue();
                $dni = '202300' . $row;
                $course = $worksheet->getCell('N'.$row)->getValue();

                $studentId = Student::create([
                    'name'=>$name,
                    'surname'=>$surname,
                    'dni'=>$dni,
                    'course'=>$course
                ])->id;

                $mar = $worksheet->getCell('C'.$row)->getValue();
                $apr = $worksheet->getCell('D'.$row)->getValue();
                $may = $worksheet->getCell('E'.$row)->getValue();
                $jun = $worksheet->getCell('F'.$row)->getValue();
                $jul = $worksheet->getCell('G'.$row)->getValue();
                $aug = $worksheet->getCell('H'.$row)->getValue();
                $sep = $worksheet->getCell('I'.$row)->getValue();
                $oct = $worksheet->getCell('J'.$row)->getValue();
                $nov = $worksheet->getCell('K'.$row)->getValue();
                $dic = $worksheet->getCell('L'.$row)->getValue();

                StudentsController::payment($mar,$course,$studentId,'2023-03-01');
                StudentsController::payment($apr,$course,$studentId,'2023-04-01');
                StudentsController::payment($may,$course,$studentId,'2023-05-01');
                StudentsController::payment($jun,$course,$studentId,'2023-06-01');
                StudentsController::payment($jul,$course,$studentId,'2023-07-01');
                StudentsController::payment($aug,$course,$studentId,'2023-08-01');
                StudentsController::payment($sep,$course,$studentId,'2023-09-01');
                StudentsController::payment($oct,$course,$studentId,'2023-10-01');
                StudentsController::payment($nov,$course,$studentId,'2023-11-01');
                StudentsController::payment($dic,$course,$studentId,'2023-12-01');

            }

        }

    }
}
