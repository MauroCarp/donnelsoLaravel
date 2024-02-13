<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Birth;
use App\Models\Dead;
use App\Models\Motive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Math\BrickMathCalculator;

class BirthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $births = Birth::with('mother')->get();

        foreach ($births as $key => $birth) {
            
            $caravanMother = Animal::find($birth->idMother);
            $births[$key]['motherCaravan'] = $caravanMother['caravan'];

            $childrenCaravans = Animal::where('idBirth',$birth->id)->get();

            $births[$key]['childrenCaravans'] = array_column($childrenCaravans->toArray(),'caravan');

            if($birth->idReproductive){
                
                $caravanReproductive = Animal::find($birth->idReproductive);
                
                $births[$key]['maleCaravan'] = $caravanReproductive['caravan'];
            }
            
            $date = new Carbon($birth->date);

            $birth->date = $date->format('d-m-Y');

        }

        $males = Animal::where(['sex'=>'m','destination'=>'reproductive','active'=>1])->
        where('caravan','not like','%/%')->get();

        $malesByType = array();

        foreach ($males as $key => $male) {
            $malesByType[$male['type']][] = array('id'=>$male['id'],'caravan'=>$male['caravan']);    
        }

        $motives = Motive::all();

        return view('births',['births'=>$births,'malesByType'=>$malesByType,'motives'=>$motives]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'idMother'=>'required',
            'date'=>'required',
            'amount'=>'required',
            'sex'=>'required',
        ]);

        $validate['complications'] = $request->complications;
        $validate['deaths'] = $request->deaths;
        $validate['twins'] = isset($request->twins) ? 1 : 0;

        if($validate['sex'] == 'mf'){

            $validate['males'] = $request->males;
            $validate['females'] = $request->females;

        }

        $newBirth = Birth::create($validate);

        $mother = Animal::find($request->idMother);

        //BUSCO LOS HIJOS DE ESTA MADRE Y SELECCIONO EL NUMERO LUEGO DE LA BARRA /
        $children = Animal::where('caravan','like',$mother->caravan . '/%')
        ->where('type',$request->type)
        ->orderby('id','DESC')
        ->first('caravan');

        if(!is_null($children)){

            $numberChildren = explode('/',$children->caravan);
            $numberChildren = $numberChildren[count($numberChildren) - 1] + 1;

        } else {
            
            $numberChildren = 0;

        }

        $newAnimals = array();

        if($validate['sex'] == 'mf'){

            for ($i=0; $i < $validate['males'] ; $i++) { 
                
                $newCaravan = $mother->caravan . '/' . $numberChildren;

                $newAnimals[] = array('type'=>$request->type,
                                    'caravan'=>$newCaravan,
                                    'age'=>'RN',
                                    'destination'=>'RN',
                                    'sex'=>'m',
                                    'idBirth'=>$newBirth->id,
                                    'idDead'=>null,
                                    'active'=>true
                                );

                $numberChildren++;

            }
      
            for ($i=0; $i < $validate['females'] ; $i++) { 
                
                $newCaravan = $mother->caravan . '/' . $numberChildren;

                $newAnimals[] = array('type'=>$request->type,
                                    'caravan'=>$newCaravan,
                                    'age'=>'RN',
                                    'destination'=>'RN',
                                    'sex'=>'f',
                                    'idBirth'=>$newBirth->id,
                                    'idDead'=>null,
                                    'active'=>true

                                );

                $numberChildren++;

            }

        } else {
                
            for ($i=0; $i < $validate['amount']; $i++) { 
                
                $newCaravan = $mother->caravan . '/' . $numberChildren;

                $sex = $validate['sex'];

                $newAnimals[] = array('type'=>$request->type,
                                    'caravan'=>$newCaravan,
                                    'age'=>'RN',
                                    'destination'=>'RN',
                                    'sex'=>$sex,
                                    'idBirth'=>$newBirth->id,
                                    'idDead'=>null,
                                    'active'=>true
                                );

                $numberChildren++;

            }

        }   

        
        // SI NACE MUERTO, PASARLO A MUERTO Y DESACTIVARLO

        if($request->deaths > 0){
            
            $motive = $request->deadMotive;

            if($request->deadMotive == 'other'){

                $motive = $request->other;

                Motive::create(['name'=>$motive]);

            }
            
            if($request->sex == 'mf'){
                
                for ($i=0; $i < $request->malesDead ; $i++) { 

                    foreach ($newAnimals as $key => $animal) {

                        if ($animal['sex'] === 'm' && is_null($animal['idDead'])) {

                            $newAnimals[$key]['destination'] = 'dead';
                            $newAnimals[$key]['active'] = false;
            
                            $dead = Dead::create(['date'=>$request->date,'motive'=>$motive]);
            
                            $newAnimals[$key]['idDead'] = $dead->id;
                                    
                            break;

                        }

                    }
    
                }

                for ($i=0; $i < $request->femalesDead ; $i++) { 

                    foreach ($newAnimals as $key => $animal) {

                        if ($animal['sex'] === 'f' && is_null($animal['idDead'])) {

                            $newAnimals[$key]['destination'] = 'dead';
                            $newAnimals[$key]['active'] = false;
            
                            $dead = Dead::create(['date'=>$request->date,'motive'=>$motive]);
            
                            $newAnimals[$key]['idDead'] = $dead->id;
                                    
                            break;

                        }

                    }

                }

            } else {

                for ($i=0; $i < $request->deaths ; $i++) { 
    
                    $newAnimals[$i]['destination'] = 'dead';
                    $newAnimals[$i]['active'] = false;
    
                    $dead = Dead::create(['date'=>$request->date,'motive'=>'Nacimiento']);
    
                    $newAnimals[$i]['idDead'] = $dead->id;
    
                }

            }


        }

        Animal::insert($newAnimals);

        return redirect('births')->with(['created'=>'ok','type'=>$request->type]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $birth = Birth::with('mother')->with('father')->where('id',$id)->first();
        
        $date = new Carbon($birth->date);
        $birth->date = $date->format('d-m-Y');

        return response()->json($birth);
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
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $birth = Birth::find($id);

        Animal::where('idBirth',$birth->id)->delete();

        $birth->delete();

        return redirect('births')->with(['delete'=>'ok','type'=>'cerdo']);

    }

    public function updateBirth(Request $request){

        $birth = Birth::find($request->idBirth);

        $birth->idReproductive = $request->idMale;

        $birth->save();
        
        return response('ok',200);
    }
    
}
