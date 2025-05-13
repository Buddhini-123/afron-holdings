<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Branch;
use Auth;
use Illuminate\Support\Collection;

class BriefController extends Controller
{

    public function index($filter = null)
    {
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_brief_upload.xlsx');

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

            return view('brief.index', ['excelData' => $data, 'branch' => $branch]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading Excel file: ' . $e->getMessage());
        }
    }

    public function saveExcelStatus(Request $request)
    {
        $updatedData = $request->input('data');

        $branch = Branch::where('user_id', Auth::user()->id)->first();
        $filePath = storage_path('app/' . $branch->branch . '_brief_upload.xlsx');
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
    // Get the branch based on the authenticated user
    $branch = Branch::where('user_id', Auth::user()->id)->first();
    $filePath = storage_path('app/' . $branch->branch . '_masterlist_upload.xlsx');

    // Check if the file exists
    if (!file_exists($filePath)) {
        return back()->with('error', 'File not found.');
    }

    // Load the Excel data
    $data = Excel::toCollection(null, $filePath);
logger('Raw Excel collection:', $data->toArray());
    // Check if data is available
    if ($data->isEmpty()) {
        return back()->with('error', 'No data found in the Excel file.');
    }

    $sheet = $data->first(); // Get the first sheet

    // Check if there is enough data
    if ($sheet->count() < 2) {
        return back()->with('error', 'Insufficient data in the Excel file.');
    }

    // Extract the header row and the data rows
    $headerRow = $sheet->first();
    $rows = $sheet->slice(1); // Data rows

    // Map header to lowercase and normalize column names
    $headerMap = collect($headerRow)->mapWithKeys(function ($value, $index) {
        if ($value) {
            $normalizedKey = strtolower(str_replace([' ', '.'], '_', trim($value)));
            return [$normalizedKey => $index];
        }
        return [];
    });

    // Get the filters from the request
    $filters = [
        'se_number' => $request->se_number,
        'passport_number' => $request->passport_number,
        'status' => $request->status,
    ];

    // Validate if any filter column is missing
    foreach ($filters as $key => $value) {
        if (!empty($value) && !$headerMap->has($key)) {
            return back()->with('error', "The column '{$key}' is missing in the Excel sheet.");
        }
    }

    // Apply filters on the rows
    $filteredRows = $rows->filter(function ($row) use ($filters, $headerMap) {
        foreach ($filters as $key => $value) {
            if (!empty($value) && isset($headerMap[$key])) {
                $index = $headerMap[$key];
                // Check if the row contains the matching value
                if (!isset($row[$index]) || strtolower(trim($row[$index])) !== strtolower(trim($value))) {
                    return false;
                }
            }
        }
        return true;
    })->values();

    // Add the header row back to the filtered rows
    $sheetData = collect([$headerRow])->concat($filteredRows);

    // Return the view with the filtered data
    return view('masterlist.show', compact('sheetData', 'branch'));
}

}
