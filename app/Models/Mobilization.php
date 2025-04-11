<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mobilization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'date',
        'job_order_no',
        'company_name',
        'country',
        'position',
        'req_no',
        'total_cv',
        'bal_req_cv',
        'handle_by',
        'deadline',
        'remarks',
        'status'
    ];

    public function positions()
    {
        return $this->hasMany(MobilizationPosition::class);
    }

}
