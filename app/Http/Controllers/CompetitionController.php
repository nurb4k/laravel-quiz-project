<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
//        $comps = Competition::all() ;
        $comps= Competition::orderBy('point', 'DESC')->get();
        return view('competitions.index', ['comps' => $comps]);
    }
}
