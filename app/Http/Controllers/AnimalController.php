<?php

namespace App\Http\Controllers;

use App\Imports\AnimalsImport;
use App\Models\Animal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = Animal::where('active',1)->get();

        return view('animals',['animals'=>$animals]);
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
        $animal = Animal::find($id);

        if($request->field == 'caravan'){

            $validateCaravan = Animal::where(['caravan'=>$request->value,'type'=>$animal->type])->get('caravan');

            if(!empty($validateCaravan->toArray())){
                return response('error');
            }
            
        }

        $animal[$request->field] = $request->value;

        $animal->save();

        return response('ok',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function import(Request $request)
    {
        if($request->hasFile('animalsFile')){

            $path = $request->file('animalsFile')->getRealPath();
            dd($path);
            Excel::import(new AnimalsImport, $path);

        }

        return redirect('/animals')->with('success', 'All good!');

    }
}
