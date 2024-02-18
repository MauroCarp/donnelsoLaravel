<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();

        return view('bills',['bills'=>$bills]);
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
            'billDate'=>'required',
            'billAmount'=>'required|numeric|min:0',
            'billDescription'=>'required',
            'billType'=>'required',
        ]);

        $newBill = Bill::create(['type'=>$validate['type'],
                                 'date'=>$validate['billDate'],
                                 'amount'=>$validate['billAmount'],
                                 'description'=>$validate['billDescription'],
                                 'billType'=>$validate['billType']
        ]);

        return redirect('bills')->with(['created'=>'ok','type'=>$validate['type']]);

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
        
        $deleteBill = Bill::find($id);

        $deleteBill->delete();

        return redirect('bills')->with(['delete'=>'ok']);

    }
}
