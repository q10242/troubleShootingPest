<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeersModel extends Model
{
    use HasFactory;
    protected $table = 'employeers';
    protected $fillable = [
        'name',
        'preferred_shift',
    ];
}
