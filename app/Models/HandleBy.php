<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HandleBy extends Model
{
    use HasFactory;

    protected $table = 'handle_by';
    protected $fillable = [
        'name'
    ];
}
