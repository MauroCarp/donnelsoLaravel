<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Insemination;
use Illuminate\Http\Request;

class InseminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inseminations = Insemination::all();

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
    
    public function getFemales(Request $request)
    {        
        $females = Animal::where(['type'=>$request->type,'sex'=>'female'])->get(['id','caravan']);

        return response()->json($females);
    }


}
