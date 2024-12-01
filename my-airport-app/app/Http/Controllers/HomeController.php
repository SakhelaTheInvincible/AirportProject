<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get all airports to populate the dropdowns
        $airports = Airport::all();

        return view('homepage', compact('airports'));
    }
}