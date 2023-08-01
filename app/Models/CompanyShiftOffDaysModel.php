<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyShiftOffDaysModel extends Model
{
    use HasFactory;
    protected $table = 'company_shift_off_days';
    protected $fillable = [
        'date',
    ];
}
