<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'no_telephone',
        'email',
        'jabatan',
        'role',
        'divisi',
    ];
}
