<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftRecordModel extends Model
{
    use HasFactory;
    protected $table = 'shift_record';
    protected $fillable = [
        'shifts',
    ];
}
