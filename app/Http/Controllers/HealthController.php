<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Event;
use App\Models\Health;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $healths = Health::with('animal')->get();

        $animals = Animal::where('active',1)->get();

        $animalsByType = array();

        foreach ($animals as $key => $animal) {
            $animalsByType[$animal['type']][] = array('id'=>$animal['id'],'caravan'=>$animal['caravan']);    
        }

        return view('health',['health'=>$healths,'animalsByType'=>$animalsByType]);
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
            'date'=>'required',
            'motive'=>'required',
            'aplication'=>'required',
        ]);

        $validate['comments'] = $request->comments;
        $validate['vetCost'] = $request->vetCost;

        $caravan = '';

        if($validate['aplication'] == 'Individual'){

            $animal = Animal::find($request->caravans);

            $caravan = 'Caravana: ' . $animal->caravan;

            $validate['idAnimal'] = $request->caravans;

        }

        $health = Health::create($validate);

        $title = 'Sanidad ' . $validate['type'] . '. ' . $validate['motive'] . ' ' . $validate['aplication'] . ' ' . $caravan;

        Event::create(['start'=>$validate['date'],'end'=>$validate['date'],'title'=>$title,'referenceId'=>$health->id]);

        return redirect('health')->with(['created'=>'ok','type'=>$request->type]);
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

        $health = Health::find($id);

        $type = $health->type;

        $health->delete();

        $event = Event::where('referenceId',$id)
        ->where('title','like','Sanidad%')
        ->first('id');

        $eventToDelete = Event::find($event->id);
        $eventToDelete->delete();

        return redirect('health')->with(['delete'=>'ok','type'=>$type]);

    }
}
