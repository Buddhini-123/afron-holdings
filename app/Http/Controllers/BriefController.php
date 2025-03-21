<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Facades\Excel;

class BriefController extends Controller
{
    public function index()
    {
        $filePath = storage_path('app\brief_upload.xlsx');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Excel file not found.');
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            return view('brief.index', ['excelData' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading Excel file: ' . $e->getMessage());
        }
    }

    public function saveExcelStatus(Request $request)
    {
        $updatedData = $request->input('data');

        $filePath = storage_path('app/brief_upload.xlsx');
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
