<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Dead;
use App\Models\Motive;
use Illuminate\Http\Request;

class DeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $deaths = Dead::join('animals','deads.id','=','animals.idDead')
        ->orderby('deads.date','desc')->get(['deads.id','deads.motive','deads.date','animals.caravan','animals.type']);

        $motives = Motive::all();

        return view('deaths',['deaths'=>$deaths,'motives'=>$motives]);

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

        $validate = $request->validate([
            'type'=>'required',
            'caravan'=>'required',
            'motive'=>'required',
            'date'=>'required',
        ]);

        if($validate['motive'] == 'other'){

            $validate['motive'] = $request->other;
            Motive::create(['name'=>$request->other]);
            
        }
        
        $newDead = Dead::create(['date'=>$validate['date'],'motive'=>$validate['motive']]);

        $deadAnimal = Animal::where(['type'=>$validate['type'],'id'=>$validate['caravan']])->first();

        $deadAnimal->idDead = $newDead->id;
        $deadAnimal->active = 0;
        $deadAnimal->destination = 'dead';
        $deadAnimal->save();

        return redirect('deaths')->with(['created'=>'ok','type'=>$validate['type']]);

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
        $deadAnimal = Dead::with('dead')->find($id);

        $animal = Animal::find($deadAnimal->dead['id']);
        $animal->active = 1;
        $animal->destination = '';
        $animal->idDead = null;

        $type = $animal->type;

        $animal->save();

        $deadToDelete = Dead::find($id);

        $deadToDelete->delete();

        return redirect('deaths')->with(['delete'=>'ok','type'=>$type]);
    }
    
    public function getAnimals(Request $request)
    {

        return Animal::where(['active'=>1,'type'=>$request->type])->get();

    }
}
