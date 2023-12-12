<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Health;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $health = Health::with('animal')->get();

        $animals = Animal::where('active',1)->get();

        $animalsByType = array();

        foreach ($animals as $key => $animal) {
            $animalsByType[$animal['type']][] = array('id'=>$animal['id'],'caravan'=>$animal['caravan']);    
        }

        return view('health',['health'=>$health,'animalsByType'=>$animalsByType]);
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
}
