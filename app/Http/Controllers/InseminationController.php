<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Event;
use App\Models\Insemination;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InseminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inseminations = Insemination::all();

        foreach ($inseminations as $key => $value) {

            $caravans = Animal::whereIn('id',json_decode($value['idMothers']))->get('caravan');

            $inseminations[$key]['caravans'] = array_column($caravans->toArray(), 'caravan');

        }

        return view('inseminations',['inseminations'=>$inseminations]);
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
            'idMothers'=>'required',
        ]);

        $chanchasCaravan = Animal::whereIn('id',$validate['idMothers'])->get(['id','caravan']);

        $caravans = array_column($chanchasCaravan->toArray(), 'caravan');
        $caravans = implode(' - ' , $caravans);

        $validate['idMothers'] = json_encode($validate['idMothers']);

        Insemination::create($validate);

        $days = ($request->type == 'cerdo') ? 20 : 25;

        $birthDate = new Carbon($request->date);
        $birthDate->addDays($days);

        Event::create(['title'=>'Parto Chanchas ' . $caravans,'start'=>$birthDate,'end'=>$birthDate]);

        return redirect('inseminations')->with(['created'=>'ok','type'=>$request->type]);

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
        $insemination = Insemination::find($id);

        $event = Event::where('title','like','Parto Chanchas%')
        ->where('referenceId',$insemination->id)
        ->get('id');

        $eventToDelete = Event::find($event->toArray()[0]['id']);
        $eventToDelete->delete();

        $insemination->delete();

        return redirect('inseminations')->with('delete','ok');
    }
    
    public function getFemales(Request $request)
    {        
        $females = Animal::where(['type'=>$request->type,'sex'=>'female'])->get(['id','caravan']);

        return response()->json($females);
    }


}
