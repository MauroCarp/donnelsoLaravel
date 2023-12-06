<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $services = Service::all();

        foreach ($services as $key => $service) {
        
            $ids = json_decode($service->idMales);

            $caravans = Animal::where('type',$service->type)
            ->whereIn('id',$ids)
            ->get('caravan');

            $services[$key]['caravans'] = array_column($caravans->toArray(), 'caravan');
        }

        return view('services',['services'=>$services]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response('hola');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'type'=>'required',
            'startDate'=>'required',
            'endDate'=>'required',
            'idMales'=>'required'
        ]);
        
        $validateData['idMales'] = json_encode($validateData['idMales']);

        $ids = json_decode($validateData['idMales']);

        $caravans = Animal::where('type',$validateData['type'])
        ->whereIn('id',$ids)
        ->get('caravan');
        
        $caravans = array_column($caravans->toArray(), 'caravan');
        $caravans = implode(' - ' , $caravans);

        Service::create($validateData);

        Event::create(['title'=>'Servicio ' . $validateData['type'] . ' - Caravanas Machos: ' . $caravans,
                       'start'=>$validateData['startDate'],
                       'end'=>$validateData['endDate']
                    ]);

        return redirect('services')->with(['created'=>'ok','type'=>$validateData['type']]);

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
        return response('hola');
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        return response('hola');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = service::find($id);

        $service->delete();
        
        return redirect('services')->with('delete','ok');    }

    public function reproductiveMales(Request $request)
    {

        $reproductores = Animal::where(['type'=>$request->type,'active'=>1,'destination'=>'reproductor'])
        ->orderby('caravan','asc')
        ->get(['id','caravan']);

        return response()->json($reproductores);    

    }

    public function changeState(Request $request)
    {

        
        $service = Service::find($request->id);
        
        $service->state = !$service->state;

        $service->save();

        return response($service->state,200);    

    }
}
