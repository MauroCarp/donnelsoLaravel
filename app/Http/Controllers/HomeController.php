<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inicio()
    {
        $activeAnimals = Animal::where('active',1)
        ->selectRaw('COUNT(*) as count, type')
        ->groupBy('type')
        ->get();

        $readyAnimals = Animal::where('destination','faena')
        ->selectRaw('COUNT(*) as count, type')
        ->groupBy('type')
        ->get();

        $categorizedAnimals = array('cerdo'=>array('total'=>0,'faena'=>0),
                                    'ovino'=>array('total'=>0,'faena'=>0),
                                    'chivo'=>array('total'=>0,'faena'=>0),
                                    'vacas'=>array('total'=>0,'faena'=>0),
                                    'pollos'=>array('total'=>0,'faena'=>0)
                                );

        foreach ($activeAnimals as $value) {
            $categorizedAnimals[$value['type']]['total'] = $value['count'];
        }

        foreach ($readyAnimals as $value) {
            $categorizedAnimals[$value['type']]['faena'] = $value['count'];
        }

        return view('index',['animals'=>$categorizedAnimals]);
    }
}
