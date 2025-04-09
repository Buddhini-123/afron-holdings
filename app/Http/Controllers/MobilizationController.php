<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MobilizationImport;
use App\Models\Mobilization;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Branch;
use Auth;

class MobilizationController extends Controller
{


    public function index($filter = null)
    {
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_mobilization_upload.xlsx');

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Excel file not found.');
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // If filtering is requested and data has more than one row (headers + content)
            if ($filter && count($data) > 1) {
                $header = $data[0];
                $rows = array_slice($data, 1);

                // Find the index of the "status" column (case-insensitive match)
                $statusIndex = array_search('status', array_map('strtolower', $header));

                if ($statusIndex !== false) {
                    $rows = array_filter($rows, function ($row) use ($statusIndex, $filter) {
                        return isset($row[$statusIndex]) && strtolower($row[$statusIndex]) === strtolower($filter);
                    });
                    $data = array_merge([$header], $rows); // Recombine header + filtered rows
                }
            }

            return view('mobilization.index', ['excelData' => $data, 'branch' => $branch]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading Excel file: ' . $e->getMessage());
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new MobilizationImport, $request->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }

    public function saveExcel(Request $request)
    {
        $updatedData = $request->input('data');

        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app\\' . $branch->branch . '_mobilization_upload.xlsx');
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Update the sheet with the new data
        foreach ($updatedData as $rowIndex => $row) {
            foreach ($row as $colIndex => $cellValue) {
                $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 1, $cellValue);
            }
        }

        // Save the updated file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filePath);

        return response()->json(['success' => true]);
    }
}
