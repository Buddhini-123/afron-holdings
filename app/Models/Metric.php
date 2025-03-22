<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metric extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'calls',
        'customer_visited',
        'approved',
        'selected'
    ];
}
