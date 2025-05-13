<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocsImport implements ToCollection, WithHeadingRow
{
    // Specify the header row
    public function headingRow(): int
    {
        return 1; // This assumes the first row of your Excel sheet contains headers
    }

    // This will return the rows as a collection
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
