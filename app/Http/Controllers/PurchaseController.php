<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Provider;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::orderby('name','asc')->get();

        $purchases = Purchase::with('provider')->orderby('date','asc')->get();

        return view('purchases',['providers'=>$providers,'purchases'=>$purchases]);
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

        $dataAnimals = array();
        
        $validate = $request->validate([
            'type'=>'required',
            'date'=>'required',
            'destination'=>'required',
            'cost'=>'required',
            'kg'=>'required',
        ]);

        if($request->newProvider != null){
            
            $providerId = Provider::create(['name'=>$request->newProvider]);

            $validate['idProvider'] = $providerId->id;

        } else {
            
            $validate['idProvider'] = $request->idProvider;

        }

        $providerName = Provider::find($validate['idProvider'])->pluck('name');

        if($request->type != 'pollos'){
            
            $validate['males'] = $request->males; 
            $validate['females'] = $request->females; 
            $validate['amount'] = $request->males + $request->females;

            $newPurchase = Purchase::create($validate);

            $averageWeight = $validate['kg'] / $validate['amount'];

            for ($i=0; $i < $validate['males']; $i++) { 
                $dataAnimals[] = array('type'=>$request->type,
                                       'caravan'=>$providerName[0] . '-M-' . ($i + 1),
                                       'weight'=>$averageWeight,
                                       'sex'=>'male',
                                       'destination'=>$request->destination,
                                       'idPurchase'=>$newPurchase->id);
            }

            for ($i=0; $i < $validate['females']; $i++) { 
                $dataAnimals[] = array('type'=>$request->type,
                                       'caravan'=>$providerName[0] . '-H-' . ($i + 1),
                                       'weight'=>$averageWeight,
                                       'sex'=>'female',
                                       'destination'=>$request->destination,
                                       'idPurchase'=>$newPurchase->id);            
            }

            Animal::insert($dataAnimals);

        } else {

            $validate['amount'] = $request->amount;

            $averageWeight = $validate['kg'] / $validate['amount'];

            $newPurchase = Purchase::create($validate);

            $dataAnimals = array('type'=>$request->type,
                                 'weight'=>$averageWeight,
                                 'destination'=>$request->destination,
                                 'idPurchase'=>$newPurchase->id);  

            Animal::create($dataAnimals);
            
        } 

        return redirect('purchases')->with('purchase','ok');

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
        $purchase = Purchase::find($id);

        $purchase->delete();

        return redirect('purchases')->with('delete','ok');

    }
}
