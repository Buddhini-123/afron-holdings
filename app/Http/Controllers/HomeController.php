<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $vacantHouses = User::where('is_vacant', 1)->count();
        $nonVacantHouses = User::where('is_vacant', 0)->count();
        return view('home', compact('vacantHouses', 'nonVacantHouses'));
    }

    public function overview()
    {
        return view('master-list');
    }
}
