<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Event;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sales = Sale::orderBy('preSale','desc')
        ->orderBy('deliveryDate','desc')->get();

        foreach ($sales as $key => $sale) {

            switch ($sale->type) {

                case 'ovino':
                    $sales[$key]['type'] = 'Cordero';
                    break;

                case 'cerdo':
                    $sales[$key]['type'] = 'Lechón';
                    break;
                
                default:
                    break;
            }

        }
        return view('sales',['sales'=>$sales]);

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
            'client'=>'required',
            'type'=>'required',
            'deliveryDate'=>'required',
        ]);

        $validate['amountEntire'] = $request->amountEntire ?? 0;
        $validate['amountHalf'] = $request->amountHalf ?? 0;
        $validate['amountRibs'] = $request->amountRibs ?? 0;
        $validate['amountShoulder'] = $request->amountShoulder ?? 0;
        $validate['amountRearQuarter'] = $request->amountRearQuarter ?? 0;
        $validate['amountHead'] = $request->amountHead ?? 0;
        $validate['amountGround'] = $request->amountGround ?? 0;
        $validate['amountMeat'] = $request->amountMeat ?? 0;
        $validate['amountSalame'] = $request->amountSalame ?? 0;

        $validate['preSale'] = 1;

        $sale = Sale::create($validate);

        if ($request->type == 'cerdo'){
           $type = 'Lechón';
        } else if ($request->type == 'ovino'){
            $type = 'Cordero';
        } else {
            $type = $request->type; 
        }

        Event::create(['title'=>'Venta: ' . $type . ' para ' . $request->client . '. Sin Confirmar',
                       'start'=>$request->deliveryDate,
                       'end'=>$request->deliveryDate,
                       'referenceId'=>$sale->id
        ]);

        return redirect('sales')->with('created','ok');

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

        $sale = Sale::find($id);

        $event = Event::where('referenceId',$sale->id)
        ->where('title','like','Venta:%')
        ->first();

        $event->delete();

        $sale->delete();

        return redirect('sales')->with('delete','ok');

    }

    public function finalize(Request $request){

        $sale = Sale::find($request->idSale);

        $sale->kgEntire = $request->kgEntire;
        $sale->kgHalf = $request->kgHalf;
        $sale->kgRibs = $request->kgRibs;
        $sale->kgShoulder = $request->kgShoulder;
        $sale->kgRearQuarter = $request->kgRearQuarter;
        $sale->kgHead = $request->kgHead;
        $sale->kgGround = $request->kgGround;
        $sale->kgMeat = $request->kgMeat;
        $sale->kgSalame = $request->kgSalame;

        $sale->preSale = 0;

        $sale->save();

        
        if ($sale->type == 'cerdo'){
            $type = 'Lechón';
         } else if ($sale->type == 'ovino'){
             $type = 'Cordero';
         } else {
             $type = $sale->type; 
         }
 
         $event = Event::where('referenceId',$sale->id)
         ->where('title','like','Venta:%')
         ->first();

         if(!is_null($event)){

             $event->title = 'Venta: ' . $type . ' para ' . $sale->client . '. Confirmado';
             $event->save();
             
        } else {

            Event::create(['title'=>'Venta: ' . $type . ' para ' . $sale->client . '. Confirmado',
                           'start'=>$sale->deliveryDate,
                           'end'=>$sale->deliveryDate,
                           'referenceId'=>$sale->id]);
             
         }

        return redirect('sales')->with('finalize','ok');

    }

    public function getDetails(Request $request){

        $saleDetail = Sale::find($request->id);

        $sections = DB::select('SELECT DISTINCT(section) FROM costs');

        $sections = array_column($sections,'section');
        // $costs = Cost::where('type',$saleDetail->type)->get();
        $costs = array();

        foreach ($sections as $section) {
            
            $cost = Cost::where(['type'=>$saleDetail->type,'section'=>$section])
            ->where('created_at','<=',$saleDetail->deliveryDate)
            ->orderby('created_at','desc')
            ->first();

            $costs[$section] = $cost->cost * $saleDetail['kg' . ucfirst($section)];

        }

        $saleDetail['costs'] = $costs;

        return response()->json($saleDetail->toArray());

    }
}
