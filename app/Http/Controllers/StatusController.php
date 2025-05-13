<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Branch;
use App\Models\HandleBy;
use Auth;

class StatusController extends Controller
{
    public function index()
    {
        $filePath = storage_path('app\status_upload.xlsx');
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_status_upload.xlsx');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Excel file not found.');
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            return view('status.index', ['excelData' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading Excel file: ' . $e->getMessage());
        }
    }

    public function saveExcelStatus(Request $request)
    {
        $updatedData = $request->input('data');

        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_status_upload.xlsx');

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
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_status_upload.xlsx');

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

        // Map of filter keys => Excel header labels
        $filterToLabel = [
            'handle_by' => 'Handle By',
            'job_order_no' => 'Job Order No'
        ];

        // Create a header map: "Handle By" => index
       $headerMap = collect($headerRow)
        ->filter(function ($value) {
            return !is_null($value) && $value !== '';
        })
        ->mapWithKeys(function ($value, $index) {
            return [$value => $index];
        });

        // Validate filter keys
        foreach ($filterToLabel as $key => $columnLabel) {
            if (!empty($request->$key) && !$headerMap->has($columnLabel)) {
                return back()->with('error', "The column '{$columnLabel}' is missing in the Excel sheet.");
            }
        }

        // Filter rows
        $filteredRows = $rows->filter(function ($row) use ($request, $filterToLabel, $headerMap) {
            foreach ($filterToLabel as $key => $label) {
                $filterValue = $request->$key;
                if (!empty($filterValue)) {
                    $index = $headerMap[$label];
                    if (!isset($row[$index]) || stripos($row[$index], $filterValue) === false) {
                        return false;
                    }
                }
            }
            return true;
        });

        // Combine header and filtered data
        $sheetData = collect([$headerRow])->concat($filteredRows)->values();
        $handlers = HandleBy::all();

        return view('status.show', compact('sheetData', 'handlers'));
    }

}
