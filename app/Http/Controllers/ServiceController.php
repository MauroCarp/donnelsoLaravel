<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cerdosReproductores = Animal::where(['type'=>'cerdo','active'=>1,'destination'=>'reproductor'])
        ->orderby('caravan','asc')
        ->get(['id','caravan']);

        return view('services',['cerdosReproductores'=>$cerdosReproductores]);

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

        $validateData = $request->validate([
            'type'=>'required',
            'startDate'=>'required',
            'endDate'=>'required',
            'idMales'=>'required'
        ]);
        
        $validateData['idMales'] = json_encode($validateData['idMales']);
        
        Service::create($validateData);

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
        //
    }

    public function reproductiveMales(Request $request)
    {

        $reproductores = Animal::where(['type'=>$request->type,'active'=>1,'destination'=>'reproductor'])
        ->orderby('caravan','asc')
        ->get(['id','caravan']);

        return response()->json($reproductores);    

    }
}
