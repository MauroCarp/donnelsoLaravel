<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Birth;
use App\Models\Dead;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

            $births[$key]['childrenCaravans'] = implode(' , ',array_column($childrenCaravans->toArray(),'caravan'));

            if($birth->idReproductive){
                
                $caravanReproductive = Animal::find($birth->idReproductive);
                
                $births[$key]['maleCaravan'] = $caravanReproductive['caravan'];
            }
            
            $date = new Carbon($birth->date);

            $birth->date = $date->format('d-m-Y');

        }

        return view('births',['births'=>$births]);
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

        $sex = 'm';
        
        for ($i=0; $i < $validate['amount']; $i++) { 
            
            $newCaravan = $mother->caravan . '/' . $numberChildren;
            
            if($validate['sex'] == 'mf'){
                
                if($sex == 'm'){
                    $sex = 'f';
                } else {
                    $sex = 'm';
                } 


            } else {
                $sex = $validate['sex'];
            }

            $newAnimals[] = array('type'=>$request->type,
                                    'caravan'=>$newCaravan,
                                    'age'=>'RN',
                                    'destination'=>'RN',
                                    'sex'=>$sex,
                                    'idBirth'=>$newBirth->id,
                                );

            $numberChildren++;

        }

        // SI NACE MUERTO, PASARLO A MUERTO Y DESACTIVARLO

        if($request->deaths > 0){

            for ($i=0; $i < $request->deaths ; $i++) { 

                $newAnimals[$i]['destination'] = 'dead';
                $newAnimals[$i]['active'] = false;

                $dead = Dead::create(['date'=>$request->date,'motive'=>'Nacimiento']);

                $newAnimals[$i]['idDead'] = $dead->id;
                
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
    public function update(Request $request, string $id)
    {
        //
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
}
