<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftOffModel extends Model
{
    use HasFactory;
    protected $table = 'employee_shift_off_days';
    protected $fillable = [
        'date',
        'employee_id',
    ];
}
