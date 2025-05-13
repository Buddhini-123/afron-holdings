<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\Models\Branch;
use Illuminate\Support\Collection;

class DocsController extends Controller
{
    public function index()
    {
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_re_upload.xlsx');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Excel file not found.');
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            return view('docs.index', ['excelData' => $data, 'branch' => $branch]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading Excel file: ' . $e->getMessage());
        }
    }

    public function saveExcelRE(Request $request)
    {
        $updatedData = $request->input('data');

        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_re_upload.xlsx');
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

    public function showExcelData(Request $request)
{
    $branch = Branch::where('user_id', Auth::id())->first();
    $filePath = storage_path('app/' . $branch->branch . '_re_upload.xlsx');

    if (!file_exists($filePath)) {
        return back()->with('error', 'File not found.');
    }

    $data = Excel::toCollection(null, $filePath);

    if ($data->isEmpty()) {
        return back()->with('error', 'No data found in the Excel file.');
    }

    $sheet = $data->first();

    if ($sheet->count() < 2) {
        return back()->with('error', 'Insufficient data in the Excel file.');
    }

    $headerRow = $sheet->first();
    $rows = $sheet->slice(1); // skip header

    // Normalize header row keys (lowercase, snake_case)
    $headerMap = collect($headerRow)->mapWithKeys(function ($value, $index) {
        if ($value) {
            $normalizedKey = strtolower(str_replace([' ', '.', '-', '/'], '_', trim($value)));
            return [$normalizedKey => $index];
        }
        return [];
    });

    // Map your request filters to match column names in Excel (normalized)
    $filters = [
        'passport_number' => $request->passport_number,
        'job_order_no' => $request->job_order_no,
        'handover_date' => $request->handover_date,
        'status' => $request->status,
    ];

    // Filter data rows
    $filteredRows = $rows->filter(function ($row) use ($filters, $headerMap) {
        foreach ($filters as $key => $value) {
            if (!empty($value) && isset($headerMap[$key])) {
                $index = $headerMap[$key];
                $cell = $row[$index] ?? null;

                // Match dates exactly (or adjust with Carbon for range/flexibility if needed)
                if (strtolower(trim((string) $cell)) !== strtolower(trim($value))) {
                    return false;
                }
            }
        }
        return true;
    })->values();

    // Recombine header and filtered rows
    $sheetData = collect([$headerRow])->concat($filteredRows);

    return view('docs.show', compact('sheetData'));
}
}
