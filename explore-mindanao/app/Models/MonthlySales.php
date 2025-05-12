<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySales extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'total',
        'bookings_count',
        'packages_count'
    ];

    // No timestamps needed for this table
    public $timestamps = false;
}
