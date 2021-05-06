<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'year',
        "status",
        "registration_date",
        'pay_per_minute',
        'number_plate',
        "maintenance_end",
        "insurance_end",
        "registration_certificate_number"
    ];
}
