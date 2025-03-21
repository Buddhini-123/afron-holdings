<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MobilizationImport;
use App\Models\Mobilization;

class MobilizationController extends Controller
{
    public function index()
    {
        $mobilization = Mobilization::all();
        return view('mobilization.index', compact('mobilization'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new MobilizationImport, $request->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
}
