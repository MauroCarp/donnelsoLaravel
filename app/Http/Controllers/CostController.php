<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $sections = DB::select('SELECT DISTINCT(section) FROM costs');
        $sections = array_column($sections,'section');

        $costs = array();

        foreach ($sections as $key => $section) {
            $cost = Cost::where(['type'=>$request->typeCost,'section'=>$section])
            ->orderby('created_at','desc')
            ->first();

            $costs[$section] = $cost['cost'];

        }

        foreach ($sections as $key => $section) {

            if($costs[$section] != $request['cost' . ucfirst($section) . $request->typeCost]){
                // dump('hola');
                Cost::create(['type'=>$request->typeCost,'section'=>$section,'cost'=>$request['cost' . ucfirst($section) . $request->typeCost]]);

            }

        }

        return back()->with('update','ok');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cost $cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cost $cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cost $cost)
    {
        //
    }

    public function getCosts(Request $request)
    {
        $costs = array('historial'=> array(),'actual'=> array());

        $historial = Cost::where('type',$request->type)->orderby('created_at','desc')->get();

        foreach ($historial as $key => $cost) {

            $costs['historial'][$cost->section][] = array('date'=>$cost->created_at,'cost'=>$cost->cost);

        }     
        
        $sections = DB::select('SELECT DISTINCT(section) FROM costs');
        $sections = array_column($sections,'section');

        foreach ($sections as $key => $section) {
            $cost = Cost::where(['type'=>$request->type,'section'=>$section])
            ->orderby('created_at','desc')->first();

            $costs['actual'][$section] = $cost['cost'] ?? 0;

        }
        
        return response()->json($costs);

    }
}
