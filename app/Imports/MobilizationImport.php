<?php

namespace App\Imports;

use App\Models\Mobilization;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class MobilizationImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mobilization([
            'user_id'       => $row['user_id'],
            'branch_id'     => $row['branch_id'],
            'date'          => $row['date'],
            'job_order_no'  => $row['job_order_no'],
            'company_name'  => $row['company_name'],
            'country'       => $row['country'],
            'position'      => $row['position'],
            'req_no'        => $row['req_no'],
            'total_cv'      => $row['total_cv'],
            'bal_req_cv'    => $row['bal_req_cv'],
            'handle_by'     => $row['handle_by'],
            'deadline'      => $row['deadline'],
            'remarks'       => $row['remarks'],
            'status'        => $row['status'],
        ]);
    }
}
