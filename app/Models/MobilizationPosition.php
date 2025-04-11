<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MobilizationPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobilization_id',
        'position',
        'req_no',
        'total_cv',
        'bal_req_cv'
    ];

    public function mobilization()
    {
        return $this->belongsTo(Mobilization::class);
    }
}
